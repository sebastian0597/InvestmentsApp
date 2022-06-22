<?php

namespace App\Http\Traits;

use App\Utils\ProfitabilityDate;
use App\Utils\Util;
use App\Models\Investment;
use App\Models\Customer;
use App\Models\User;
use App\Models\InvestmentType;
use App\Models\PaymentMethod;
use App\Models\Reinvestment;

use App\Models\Extract;
use App\Models\ExtractDetail;

use Illuminate\Support\Facades\DB;

trait InvestmentTrait
{
    public function storeInvestment($request, $customer_id="")
    {
        //Se validan los campos que son obligatorios para crear una inversón.
        $fields = $request->validate([

            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'base_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'consignment_file' => '',
            'code_currency' => 'required|string',
            'id_payment_method' => 'required|numeric',
            'registered_by' => 'required|numeric',
            'document_number' => 'required'
 
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
            
            $consignment_file = "consignment_file_".$fields['document_number'].".".$file->guessExtension();
            $ruta = public_path("archivos/consiganciones/".$consignment_file);
            copy($file, $ruta);
        }
        //Se crea la inversión.
        $investment = Investment::create([
            'id_customer' =>  $id_customer,
            'base_amount' => $fields['base_amount'],
            'amount' => $fields['amount'],
            'initial_amount' =>$fields['amount'],
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
        $customer->update();

        //Se busca si es una reinversión o una nueva inversión
        $investment_type = InvestmentType::find($investment_type);
       
        //Si es una nueva inversión se envía el pagaré al correo del administrador.
        if($investment_type->ind_generate_bank_note == 1){

            $admin_logged = User::find($fields["registered_by"]);
            $customer_fullname = $customer->name." ".$customer->last_name;
            $dataAdmin["email"] = $admin_logged->email;
            $dataAdmin["title"] = "Pagaré del cliente ".$customer->document_number." ".$customer_fullname;
            $dataAdmin["amount"] = $fields['amount'];
            $dataAdmin["investment_date"] = date('d/m/Y');
            $dataAdmin["bank_promissor_number"] = $investment->id;
            $dataAdmin["document_number"] = $customer->document_number;
            $dataAdmin["customer_name"] = $customer_fullname;
            $dataAdmin["document_name"] = "Contrato_inversion_".$customer->document_number."_".$customer_fullname;

            if($customer_type == 1 || $customer_type == 2){//Standard o VIP

                Util::sendEmailWithPDFFile('Pdfs.bank_promissor_note', $dataAdmin);

            }else if($customer_type == 3){//Premium

                Util::sendEmailWithPDFFile('Pdfs.bank_promissor_note', $dataAdmin);
            }
           
        }

        return "Se ha creado la inversión correctamente.";
    }

    public function storeReinvestment($request, $customer_id="")
    {
        //Se validan los campos que son obligatorios para crear una inversón.
        $fields = $request->validate([

            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'registered_by' => 'required|numeric',
            'document_number' => 'required',
            'id_customer' => 'required',
            'investment_id' => 'required',
 
        ]);

        $id_customer = $customer_id == "" || is_null($customer_id) ?  $request->id_customer : $customer_id;
        $investment_type = 1;// $request->id_investment_type == "" || is_null($request->id_investment_type) ? 2 : $request->id_investment_type;

        //Se consulta inversion a la cual se le asignara el valor de rentabilidad al capital
        $investment = Investment::find($fields['investment_id']);

        $new_amount = $investment->amount + intval($fields['amount']);

        //Se configura la fecha de inicio de rentabilidad del siguiente mes.
        $next_month = 0;
        if(date('m')<12){
            $next_month = date('m')+1;
        }else{
            $next_month = intval('01');
        }

        $date = ProfitabilityDate::create(date('Y'),$next_month, intval('01'));
      
        $date->addBussinessDays(0);
        $profibality_date = $date->toDateString();
        
        //Se actualiza el nuevo monto de la inversion y la fecha de inicio de rentabilidad
        $investment->amount = $new_amount;
        $investment->profitability_start_date = $profibality_date;
        $investment->update();

        //Se crea la reinversón
        $reinvestment = Reinvestment::create([

            'id_customer' => $id_customer,
            'id_investment' => $investment->id,
            'amount' => intval($fields['amount']),
            'reinvestment_date' => date('Y-m-d'),
            'id_investment_type' => 1,
            'registered_by' => auth()->user()->id,

        ]);

        $extractDetails = ExtractDetail::getExtractDetailsByIdInvestment($investment->id);
            foreach($extractDetails as $extractDetail){
                $extractDetail->status = 2;
                $extractDetail->update();
        }
      
        //Se buscan los extractos activos y se les coloca en estado 2.
        $extracts = Extract::getExtractByCustomerAndStatus($id_customer);
        
        foreach($extracts as $extract){
            $extract->status = 2;
            $extract->update();
        }
       
        //Se consultan todas las inversiones activas del cliente y se suman, para actualizar la clasificación del mismo.
        $total_amount = Investment::getTotalInvestmentCustomer($id_customer);
        $customer_type = Util::validateCustomerLevel($total_amount);
        $customer = Customer::find($id_customer);
        $customer->id_customer_type = $customer_type;
        $customer->status = 1;
        $customer->save();

        return "Se ha creado la reinversión correctamente.";
    }



    public function setPercentage($percentage, $id_customer){

        DB::statement(" UPDATE investments I 
        INNER JOIN customers C ON C.id = I.id_customer 
        SET I.percentage_investment=?
        WHERE C.id=? AND I.status=1",
        [$percentage, $id_customer]);
        
    }
}