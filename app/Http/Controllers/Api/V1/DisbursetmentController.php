<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disbursetment;
use App\Models\Investment;
use App\Models\Customer;
use App\Models\User;
use App\Models\Extract;

use App\Http\Traits\DisbursetmentTrait;
use App\Http\Traits\InvestmentTrait;

use App\Http\Resources\V1\DisbursementResource;
use App\Http\Resources\V1\DisbursementCollection;


use Illuminate\Support\Facades\DB;
use App\Utils\Util;

class DisbursetmentController extends Controller
{

    use DisbursetmentTrait;
    use InvestmentTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $request_answer = DB::transaction(function () use($request){
            
            $fields = $request->validate([
                'id_disbursement_type' => 'required|numeric',
                'id_customer' => 'required|numeric',
                'disbursement_amount' => 'required|numeric',
                'profibality_amount' => 'required|numeric'

            ]);
            

            switch ($fields['id_disbursement_type']){//Tipos de desembolso
                
                case '1'://Rentabilidad Mensual

                   
                    //generar informe de desembolso
                    //cargar informe de desembolso 
                    

                    break;
                case '2'://Capital Parcial

                        $amount_profibality_month = $fields['profibality_amount'];
                        
                        //Consulto las inversiones activas del cliente
                        $investments = Investment::getInvestmentsByIdCustomer($fields['id_customer']);
                        $customer = Customer::find($fields['id_customer']);
                        $consignment_file = NULL;

                        //Se consultan los extractos activos y se les coloca el estado 2, que significa desembolsado.
                        $extracts = Extract::getExtractByCustomerAndStatus($fields['id_customer']);


                        Util::inactivateInvestments($investments);
                        Util::inactivateExtracts($extracts);

                        $amount = ($amount_profibality_month-$fields['disbursement_amount']);
                        
                        //Se serializa el Request para crear la nueva inversión.
                        $request->request->add(['amount' => $amount]); 
                        $request->request->add(['base_amount' => $amount]);
                        $request->request->add(['consignment_file' => $consignment_file]);
                        $request->request->add(['code_currency' => 'COP']);
                        $request->request->add(['id_payment_method' => 1]);
                        $request->request->add(['registered_by' => 1]);
                        $request->request->add(['document_number' =>  $customer->document_number]); //add request
                       
                        $investment = $this->storeInvestment($request, $fields['id_customer']);
                        $disbursement = $this->storeDisbursetment($request);
                        
                        if($disbursement){

                            return array(201, 'Se ha creado el desembolso correctamente para el cliente '.$customer->name.' '.$customer->last_name);

                        }else{
                            return array(501, 'Ha ocurrido un error al momento de crear el desembolso, por favor intente nuevamente '.$customer->name.' '.$customer->last_name);
                        }
                        
                        //Generar informe de desembolso Capital Parcial
                        //valor a consignar y demás datos

                    break;
                
                case '3'://Capital Total
                   
                    $investments = Investment::getInvestmentsByIdCustomer($fields['id_customer']);
                    $extracts = Extract::getExtractByCustomerAndStatus($fields['id_customer']);
                    $customer = Customer::find($fields['id_customer']);

                    Util::inactivateInvestments($investments);
                    Util::inactivateExtracts($extracts);
                    
                    //Se crea el desembolso
                    $disbursement = $this->storeDisbursetment($request);
                    
                    //Se inactiva el cliente
                    $customer = Customer::find($fields['id_customer']);
                    $customer->status=0;
                    $customer->save();

                    $user = User::find($customer->id_user);
                    $user->status=0;
                    $user->save();

                    //Util::downloadPDF();

                    if(!$disbursement){
                        return array(501, 'Ha ocurrido un error al intentar crear el desembolso.');
                    }

                    if($customer->save()){
                        return array(201, 'Se ha creado el desembolso de manera correcta.');

                    }else{
                        return array(501, 'Ha ocurrido un error al intentar desactivar cliente.');
                    }
                            
                    break;
            }


        }, 3); 
    
            return Util::setResponseJson($request_answer[0], $request_answer[1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {   
        $disbursements = Disbursetment::getDisbursement($date);

        if($disbursements){
            return new DisbursementCollection($disbursements);
        }else{
            return array();
        }
    }

    /*public function show($id)
    {
        return new DisbursementResource(Disbursement::find($id));

    }*/

    public function showByParam($param)
    {
        $disbursements = Disbursetment::getDisbursementsByParams($param);

        if($disbursements){
            
            return new DisbursementCollection($disbursements);
            
        }else{
            return array();
        }
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $request_answer = DB::transaction(function () use($request, $id){
            
            $fields = $request->validate([
                'disbursement_file' => 'required',

            ]);

            $disbursement = Disbursetment::find($id);

            $customer = Customer::find($disbursement->id_customer);

            $file_document=$fields['disbursement_file'];

            if($request->hasFile("disbursement_file")){
                $file=$request->file("disbursement_file");
                
                $file_document = "documento_".$customer->document_number.".".$file->guessExtension();
                $ruta = public_path("archivos/desembolsos/".$file_document);
                copy($file, $ruta);
            }

            $disbursement->disbursetment_file = $file_document;
            $disbursement->ind_done = $request->ind_desembolsado;
            $disbursement->update();

        }, 3); 
        
            return Util::setResponseJson(201, 'Se ha actualizado el desembolso correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
