<?php

namespace App\Http\Traits;

use App\Utils\ProfitabilityDate;
use App\Utils\Util;
use App\Models\Investment;
use App\Models\Customer;
use App\Models\User;
use App\Models\InvestmentType;
use App\Models\PaymentMethod;

use Illuminate\Support\Facades\DB;

trait InvestmentTrait
{
    public function storeInvestment($request, $customer_id="")
    {
        //Se validan los campos que son obligatorios para crear una inversón.
        $fields = $request->validate([

            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'consignment_file' => 'required|file',
            'code_currency' => 'required|string',
            'id_payment_method' => 'required|numeric',
            'registered_by' => 'required|numeric',
 
        ]);

        $id_customer = $customer_id == "" || is_null($customer_id) ?  $request->id_customer : $customer_id;
        $investment_type = $request->id_investment_type == "" || is_null($request->id_investment_type) ? 2 : $request->id_investment_type;

        $payment_method = PaymentMethod::find($fields['id_payment_method']);
        $date = ProfitabilityDate::create(date('Y'),date('m'),date('d'));
        $date->addBussinessDays($payment_method->enabling_days);
        $profibality_date = $date->toDateString();

        $consignment_file=NULL;
        //$consignment_file='Consignacion_2.pdf';
        if($request->hasFile("consignment_file")){
            $file=$request->file("consignment_file");
            
            $consignment_file = "rut_".$request->document_number.".".$file->guessExtension();
            $ruta = public_path("archivos/consiganciones/".$consignment_file);
            copy($file, $ruta);
        }
        //Se crea la inversión.
        $investment = Investment::create([
            'id_customer' =>  $id_customer,
            'base_amount' => $fields['amount'],
            'amount' => $fields['amount'],
            'consignment_file' => $consignment_file,
            'code_currency' => $fields['code_currency'],
            'other_currency' => $request->other_currency,
            'id_payment_method' => $fields['id_payment_method'],
            'investment_date' => date('Y-m-d h:i:s'),
            'id_investment_type' => $investment_type,
            'profitability_start_date' => $profibality_date,
            'registered_by' => $fields["registered_by"],
        ]);

        $investment->save();

        //Se consultan todas las inversiones activas del cliente y se suman, para actualizar la clasificación del mismo.
        $total_amount = Investment::getTotalInvestmentCustomer($id_customer);
        $customer_type = Util::validateCustomerLevel($total_amount);
        $customer = Customer::find($id_customer);
        $customer->id_customer_type = $customer_type;
        $customer->status = 1;
        $customer->save();

        //Se busca si es una reinversión o una nueva inversión
        $investment_type = InvestmentType::find($investment_type);
       
        //Si es una nueva inversión se envía el pagaré al correo del administrador.
        if($investment_type->ind_generate_bank_note == 1){

            $adminLogged = User::find(1);
            $customer_fullname = $customer->name." ".$customer->last_name;
            $dataAdmin["email"] = $adminLogged->email;
            $dataAdmin["title"] = "Pagaré del cliente ".$customer->document_number." ".$customer_fullname;
            $dataAdmin["amount"] = $fields['amount'];
            $dataAdmin["bank_promissor_number"] = $investment->id;
            $dataAdmin["document_number"] = $customer->document_number;
            $dataAdmin["customer_name"] = $customer_fullname;
            $dataAdmin["document_name"] = "Pagare_".$customer->document_number."_".$customer_fullname;
            
            Util::sendEmailWithPDFFile('Pdfs.bank_promissor_note', $dataAdmin);
        }

        return $investment;
    }

    public function setPercentage($percentage, $id_customer){

        DB::statement(" UPDATE investments I 
        INNER JOIN customers C ON C.id = I.id_customer 
        SET I.percentage_investment=?
        WHERE C.id=? AND I.status=1",
        [$percentage, $id_customer]);
        
    }
}