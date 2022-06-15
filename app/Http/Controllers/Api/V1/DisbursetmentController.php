<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disbursetment;
use App\Models\Investment;
use App\Models\Customer;
use App\Models\User;
use App\Models\Extract;
use App\Models\ExtractDetail;


use App\Http\Traits\DisbursetmentTrait;
use App\Http\Traits\InvestmentTrait;

use App\Http\Resources\V1\DisbursementResource;
use App\Http\Resources\V1\DisbursementCollection;

use Illuminate\Support\Facades\DB;
use App\Utils\Util;

use App\Exports\DisbursetmentExport;

use Excel;

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

                   $extracts = Extract::join('customers', 'customers.id', '=', 'extracts.id_customer')
                   ->select('customers.name', 'customers.last_name', 'customers.document_number', 'customers.phone', 'customers.account_number', 
                   'customers.account_type', 'customers.bank_name', 'customers.id_customer_type',  'extracts.grand_total_invested', 'extracts.profitability_percentage',  
                   'extracts.profitability_percentage', 'extracts.total_profitability','extracts.id','customers.id AS id_customer')
                    ->where('extracts.status', 1)
                    ->where('customers.id_customer_type', $request->id_customer_type)->get();
                    
                    if(count($extracts)>0){

                        foreach ($extracts as $key => $extract) {
                        
                            if(intval($extract->total_profitability)<0){
    
                                return array(402, "El porcentaje de rentabilidad de este mes ha sido negativo, por lo tanto no se puede generar desembolsos.");
    
                            }
                           
                            $investments = Investment::getInvestmentsByIdCustomer($extract->id_customer);
                         
                            foreach ($investments as $key => $investment) {
                                
                                $extract_detail = ExtractDetail::where('id_investment',$investment->id)->where('status',1)->first();
                                //Se actualizan los montos de las inversiones con los extractos generados
                                $investment->amount = intval($investment->amount) + intval($extract_detail->investment_return);
                                $investment->update();
        
                                $disbursement_amount = intval($extract_detail->investment_return);
                                
                                //Se actualiza los estados de los extractos detalle a estado 3, desembolsado.
                                $extract_detail->status = 3;
                                $extract_detail->update();
        
                                $new_amount = ($investment->amount - $disbursement_amount);
                                
                                $profibality_date = Util::profitabilityDateNextMonth();
    
        
                                if(intval($extract->total_profitability)<0){

                                    $disbursement_amount = abs($new_amount);
                                    $investment->amount_disbursement=$investment->amount_disbursement;
                                    $investment->update();
        
                                }else{
                                    $investment->amount=$new_amount;
                                    $investment->profitability_start_date=$profibality_date;
                                    $investment->amount_disbursement= intval($investment->amount_disbursement)+$disbursement_amount;
                                    $investment->update();
                                    break;
                                }
                                
                            }
    
                            //return array(201, $extract->total_profitability);
                            $request->request->set('id_customer', $extract->id_customer);
                            $request->request->set('id_disbursement_type', 1);
                            $request->request->set('disbursement_amount', $extract->total_profitability);
                            $request->request->set('month',  date('m'));
                            $request->request->set('date_create',  date('Y-m-d'));
                            $request->request->set('ind_done',  NULL);
                            $request->request->set('disbursetment_file',  NULL);
                            
                            $disbursement = $this->storeDisbursetment($request);
                            
                        }

                        $extracts_excel = Extract::join('customers', 'customers.id', '=', 'extracts.id_customer')
                        ->join('customer_types', 'customer_types.id', '=', 'customers.id_customer_type')
                        ->select('customers.name', 'customers.last_name', 'customers.document_number', 'customers.phone', 'customers.account_number', 
                        'customers.account_type', 'customers.bank_name', 'customer_types.name AS id_customer_type',  'extracts.grand_total_invested', 'extracts.profitability_percentage',  
                        'extracts.profitability_percentage', 'extracts.total_profitability')
                         ->where('extracts.status', 1)
                         ->where('customers.id_customer_type', $request->id_customer_type)->get();
    
                       
                        $myFile =  Excel::raw(new DisbursetmentExport($extracts_excel), 'Xlsx');
                        $response =  array(
                            'name' => "extracts.xlsx",
                            'file' => "data:application/vnd.ms-excel;base64,".base64_encode($myFile)
                        );

                        Util::inactivateExtracts($extracts);
                        
                        return array(201, $response);

                    }else{
                        return array(404, "No hay extractos disponibles para generar desembolsos, primero genere el extracto del mes.");
                    }

                    
                    //generar informe de desembolso

                    break;

                case '2'://Capital Parcial

                        $total_amount = $fields['profibality_amount'];
                        $disbursement_amount = intval($fields['disbursement_amount']);

                        //Consulto las inversiones activas del cliente y actualizo los montos de las inversiones
                        $investments = Investment::getInvestmentsByIdCustomer($fields['id_customer']);
                        $extracts = Extract::getExtractByCustomerAndStatus($fields['id_customer']);
                        Util::inactivateExtracts($extracts);

                        foreach ($investments as $key => $investment) {
                            
                            $extract_detail = ExtractDetail::where('id_investment',$investment->id)->where('status',1)->first();
                            //Se actualizan los montos de las inversiones con los extractos generados
                            $investment->amount = intval($investment->amount) + intval($extract_detail->investment_return);
                            $investment->update();

                            //Se actualiza los estados de los extractos detalle a estado 3, desembolsado.
                            $extract_detail->status = 3;
                            $extract_detail->update();

                            $new_amount = ($investment->amount - $disbursement_amount);
                        
                            $profibality_date = Util::profitabilityDateNextMonth();


                            if($new_amount<0){
                                $disbursement_amount = abs($new_amount);
                                $investment->amount_disbursement=$investment->amount;
                                $investment->status=3;
                                $investment->update();

                            }else{
                                $investment->amount=$new_amount;
                                $investment->profitability_start_date=$profibality_date;
                                $investment->amount_disbursement= intval($investment->amount_disbursement)+$disbursement_amount;
                                $investment->update();
                                break;
                            }
                            
                      
                        }

                        $customer = Customer::find($fields['id_customer']);
                        $consignment_file = NULL;

                        $total_amount = Investment::getTotalInvestmentCustomer($fields['id_customer']);
                        $customer_type = Util::validateCustomerLevel($total_amount);

                        $customer->id_customer_type = $customer_type;
                        $customer->update();

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

                   // Util::inactivateInvestments($investments);
                    Util::inactivateExtracts($extracts);

                    /*foreach ($extracts as $key => $extract) {
                            $extract_details = ExtractDetail::where('id_extract',$extract->id)->where('status',1)->get();

                            foreach ($extract_details as $key => $extract_detail) {
                                
                                //Se actualiza los estados de los extractos detalle a estado 3, desembolsado.
                                $extract_detail->status = 3;
                                $extract_detail->update();
                            }
                    
                    }*/

                    foreach ($investments as $key => $investment) {
                            
                        $extract_detail = ExtractDetail::where('id_investment',$investment->id)->where('status',1)->first();
                        //Se actualizan los montos de las inversiones con los extractos generados
                        //intval($investment->amount) + intval($extract_detail->investment_return);
                        
                        //Se actualiza los estados de los extractos detalle a estado 3, desembolsado.
                        $extract_detail->status = 3;
                        $extract_detail->update();

                        $disbursement_amount = $investment->amount;
                    
                        $profibality_date = Util::profitabilityDateNextMonth();

                        $investment->profitability_start_date=$profibality_date;
                        $investment->amount_disbursement= intval($investment->amount_disbursement)+$disbursement_amount;
                        $investment->status=3;
                        $investment->amount = 0; 
                        $investment->update();
                                      
                    }
                    
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
        return Disbursetment::getDisbursement($date);

       /* if($disbursements){
            return new DisbursementCollection($disbursements);
        }else{
            return array();
        }*/
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

    public function showFiles()
    {
       
        $disbursements_files = Disbursetment::getDisbursementsFiles();
       
        if($disbursements_files){
            
            return new DisbursementCollection($disbursements_files);
            
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
                
                $file_document = "desembolso_".$customer->document_number.".".$file->guessExtension();
                $ruta = public_path("archivos/desembolsos/".$file_document);
                copy($file, $ruta);
            }

            $disbursement->disbursetment_file = $file_document;
            $disbursement->ind_done = $request->ind_desembolsado;
            $disbursement->date_disbursement = date('Y-m-d');
            $disbursement->update();

        }, 3); 
        
            return Util::setResponseJson(201, 'Se ha actualizado el desembolso correctamente.');

    }
    public function updateByCustomerType(Request $request)
    {
    
        $request_answer = DB::transaction(function () use($request){
            
            $fields = $request->validate([
                'disbursement_file' => 'required',
                'customer_type' => 'required',

            ]);

        
            $customers = Customer::where('id_customer_type', $fields['customer_type'])->where('status',1)->get();

            $file_document=$fields['disbursement_file'];

            foreach ($customers as $key => $customer) {

                if($request->hasFile("disbursement_file")){
                    $file=$request->file("disbursement_file");
                    
                    $file_document = "desembolso_".$customer->document_number.".".$file->guessExtension();
                    $ruta = public_path("archivos/desembolsos/".$file_document);
                    copy($file, $ruta);
                } 
                 
                $disbursements = Disbursetment::where('id_customer', $customer->id)->whereNull('ind_done')->get();
                foreach ($disbursements as $key => $disbursement) {
                    
                    $disbursement->disbursetment_file = $file_document;
                    $disbursement->ind_done = 1;
                    $disbursement->date_disbursement = date('Y-m-d');
                    $disbursement->update();

                }
            }

        }, 3); 
        
            return Util::setResponseJson(201, 'Se ha cargado el archivo de desembolso correctamente.');

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
