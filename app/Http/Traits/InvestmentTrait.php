<?php

namespace App\Http\Traits;

use App\Utils\Util;
use App\Models\Investment;
use App\Models\Customer;
use App\Models\User;
use App\Models\InvestmentType;

trait InvestmentTrait
{
    public function storeInvestment($request, $customer_id="")
    {
        //Se validan los campos que son obligatorios para crear una inversón.
        $fields = $request->validate([

            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'consignment_file' => 'required|string',
            'id_currency' => 'required|numeric',
            'id_payment_method' => 'required|numeric',
            'registered_by' => 'required|numeric',
 
        ]);

        $id_customer = $customer_id == "" || is_null($customer_id) ?  $request->id_customer : $customer_id;
        $investment_type = $request->id_investment_type == "" || is_null($request->id_investment_type) ? 2 : $request->id_investment_type;

        //Se crea la inversión.
        $investment = Investment::create([
            'id_customer' =>  $id_customer,
            'amount' => $fields['amount'],
            'consignment_file' => $fields['consignment_file'],
            'id_currency' => $fields['id_currency'],
            'other_currency' => $request->other_currency,
            'id_payment_method' => $fields['id_payment_method'],
            'investment_date' => date('Y-m-d h:i:s'),
            'id_investment_type' => $investment_type,
            'registered_by' => $fields["registered_by"],
        ]);

        $investment->save();

        //Se consultan todas las inversiones activas del cliente y se suman, para actualizar la clasificación del mismo.
        $total_amount = Investment::getTotalInvestmentCustomer($id_customer);
        $customer_level = Util::validateCustomerLevel($total_amount);
        $customer = Customer::find($id_customer);
        $customer->customer_level = $customer_level;
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
            
            Util::sendEmailWithPDFFile('Emails.bank_promissor_note', $dataAdmin);
        }

        return $investment;
    }
}