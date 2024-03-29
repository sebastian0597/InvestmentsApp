<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Extract;
use App\Models\ExtractDetail;
use App\Models\Investment;
use App\Models\Customer;

use App\Utils\Util;
use App\Utils\ProfitabilityDate;

use App\Http\Traits\InvestmentTrait;
use App\Http\Traits\ExtractTrait;

use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\ExtractResource;
use App\Http\Resources\V1\ExtractCollection;


class ExtractController extends Controller
{
    use InvestmentTrait; use ExtractTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Extract  $extract
     * @return \Illuminate\Http\Response
     */
    public function show($id_customer)
    {
        return new ExtractCollection(Extract::getExtractByCustomerAndStatus($id_customer));
    }

    public function getByCustomer($id_customer)
    {
        return /*new ExtractCollection(*/Extract::getExtractByCustomer($id_customer);
    }

    public function getByCustomerAndDate(Request $request)
    {
        $fields = $request->validate([   
            'date' => 'required',
            'id_user' => 'required',
        ]);

        $customer = Customer::where('id_user',$fields['id_user'])->first();
        return new ExtractCollection(Extract::getExtractByCustomerAndDate($fields['date'], $customer->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Extract  $extract
     * @return \Illuminate\Http\Response
     */
    public function edit(Extract $extract)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Extract  $extract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Extract $extract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Extract  $extract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Extract $extract)
    {
        //
    }


    public function extractCustomerPremium(Request $request){

        $status = DB::transaction(function () use($request){
           
            $fields = $request->validate([   
                'document_number' => 'required|string',
                'percentage' => 'required|numeric',
            ]);
        
            //Se consultan los clientes premium
            $customer = Customer::searchCustomerByParamsAndCustomerType($fields['document_number'], 3);
            
            if($customer){
                
                $this->setPercentage($fields['percentage'], $customer->id);
                $investments = Investment::getInvestmentsByIdCustomer($customer->id);

                $total_reinvested = 0;// Investment::getTotalInvestmentCustomerByInvestmentType($customer->id, 1);
                $total_invested = Investment::getTotalInvestmentCustomer($customer->id);
                
                $arr_extract['id_customer'] = $customer->id;
                $arr_extract['total_disbursed'] = 0;
                $arr_extract['total_reinvested'] = $total_reinvested;
                $arr_extract['profitability_percentage'] = $fields['percentage'];
                $arr_extract['grand_total_invested'] = $total_invested;
                $arr_extract['registered_by'] = $request->registered_by;
                $arr_extract['month'] = date("m");
                 
                Util::deleteExtracts($customer->id, $arr_extract['month']);
                
                //Se usa la función de Extract Trait
                $extract = $this->storeExtract($arr_extract);
                              
                
                $total_investment_return=0;
                $profibality_date = Util::profitabilityDateNextMonth();

                $total_amount_invested = 0;

                foreach ($investments as $investment) {
                   
                    //Se valida si es febrero los días son 28, sin no, son 30.
                    $days = Util::validateDaysNumberByMonth(date("m"));
                    
                    //Calcula los días de rentabilidad de la inversión, a partir de la fecha en la que empieza la inversion a ser rentable
                    $profitability_days = Util::calculateProfitableDays($investment->profitability_start_date, $days);

                    $real_profitability_percentage = round((($fields['percentage']/$days)*$profitability_days), 2);
                    $investment_return = (($investment->amount)*($real_profitability_percentage/100));
                    
                    $arr_extract_details['id_extract'] = $extract->id;
                    $arr_extract_details['id_investment'] = $investment->id;
                    $arr_extract_details['monthly_profitability_percentage'] = $fields['percentage'];
                    $arr_extract_details['profitability_days'] = $profitability_days;
                    $arr_extract_details['profitability_start_date'] = $investment->profitability_start_date;
                    $arr_extract_details['real_profitability_percentage'] = $real_profitability_percentage;
                    $arr_extract_details['investment_amount'] = $investment->amount;
                    $arr_extract_details['investment_return'] = $investment_return;
                    $arr_extract_details['status'] = intval($investment_return)>0 ? 1 : 2 ;
                    $arr_extract_details['month'] = date('m');
                    
                    if(intval($investment_return) <=0){

                        $investment->amount = ($investment->amount-abs($investment_return));
                        $investment->profitability_start_date = $profibality_date;
                        $investment->save();
   
                    }

                    $total_amount_invested+=$investment->amount;
                    //Se usa la función de Extract Trait
                    $this->storeExtractDetail($arr_extract_details);
                    
                    $total_investment_return+=$investment_return;
                }

                $customer_level = Util::validateCustomerLevel($total_amount_invested);
                $customer->id_customer_type=$customer_level;
                $customer->save();

                $extract->total_profitability = $total_investment_return;
                $extract->status = intval($total_investment_return)>0 ? 1 : 2;
                $extract->save();
                
                return array(201, 'Se ha registrado el porcentaje de rentabilidad correctamente.');

            }else{

                return array(404, 'No se han encontrado inversiones para este cliente o el cliente no pertenece a la categoria premium.');
               
            }
           
        }, 3); 
        
        return Util::setResponseJson($status[0],$status[1]);
       
    }


    public function extractByCustomerType(Request $request){

        $status = DB::transaction(function () use($request){
           
            $fields = $request->validate([
                'id_customer_type' => 'required|numeric',
                'percentage' => 'required|numeric',
            ]);

            $customers = Customer::getCustomersByType($fields['id_customer_type']);

            if($customers){
            
                    foreach($customers as $customer){
          
                        //Se usa la función de Investment Trait
                        $this->setPercentage($fields['percentage'], $customer->id);

                        $total_reinvested = Investment::getTotalInvestmentCustomerByInvestmentType($customer->id, 1);
                        $total_invested = Investment::getTotalInvestmentCustomer($customer->id);
                        
                        $arr_extract['id_customer'] = $customer->id;
                        $arr_extract['total_disbursed'] = 0;
                        $arr_extract['total_reinvested'] = $total_reinvested;
                        $arr_extract['profitability_percentage'] = $fields['percentage'];
                        $arr_extract['grand_total_invested'] = $total_invested;
                        $arr_extract['registered_by'] = $request->registered_by;
                        $arr_extract['month'] = date('m');

                        //Se deben borrar los extractos que pertenezcan al mismo cliente y son del mismo mes.
                            //1. Buscar los extractos, sacar el id y buscar los extractos detalles.
                            //2. Eliminar los extractos detalles por medio del id y luego eliminar los extractos.
                        Util::deleteExtracts($customer->id, $arr_extract['month']); 

                        //Se usa la función de Extract Trait
                        $extract = $this->storeExtract($arr_extract);
                        
                        $investments = Investment::getInvestmentsByIdCustomer($customer->id);
                        $total_investment_return=0;

                        $profibality_date = Util::profitabilityDateNextMonth();

                        $total_amount_invested = 0;

                        foreach ($investments as $investment) {
                        
                            //Se valida si es febrero los días son 28, sin no, son 30.
                            $days = Util::validateDaysNumberByMonth(date("m"));
                            
                            //Calcula los días de rentabilidad de la inversión, a partir de la fecha en la que empieza la inversion a ser rentable
                            $profitability_days = Util::calculateProfitableDays($investment->profitability_start_date, $days);

                            $real_profitability_percentage = round((($fields['percentage']/$days)*$profitability_days), 2);
                            $investment_return = (($investment->amount)*($real_profitability_percentage/100));
                            
                            $arr_extract_details['id_extract'] = $extract->id;
                            $arr_extract_details['id_investment'] = $investment->id;
                            $arr_extract_details['monthly_profitability_percentage'] = $fields['percentage'];
                            $arr_extract_details['profitability_days'] = $profitability_days;
                            $arr_extract_details['profitability_start_date'] = $investment->profitability_start_date;
                            $arr_extract_details['real_profitability_percentage'] = $real_profitability_percentage;
                            $arr_extract_details['investment_amount'] = $investment->amount;
                            $arr_extract_details['investment_return'] = $investment_return;
                            $arr_extract_details['status'] = intval($investment_return)>0 ? 1 : 2 ;
                            $arr_extract_details['month'] = date('m');
                            

                            $total_investment_return+=$investment_return;

                            if(intval($investment_return) <=0){

                                $investment->amount = ($investment->amount-abs($investment_return));
                                $investment->profitability_start_date = $profibality_date;
                                $investment->save();

                               
                            }

                            $total_amount_invested+=$investment->amount;

                            //Se usa la función de Extract Trait.
                            $this->storeExtractDetail($arr_extract_details);
                        }
                              
                        $customer_level = Util::validateCustomerLevel($total_amount_invested);
                        $customer->id_customer_type=$customer_level;
                        $customer->save();

                         //Se busca el extracto creado y se coloca en estado 2                         
                        $extract->total_profitability = $total_investment_return;
                        $extract->status = intval($total_investment_return)>0 ? 1 : 2;
                        $extract->save();
                    }

                return array(201, 'Se han registrado los porcentajes de rentabilidad correctamente.');

            }else{

                return array(404, 'No se han encontrado inversiones para ese tipo de cliente.');     
            }
           
        }, 3); 
        
        return Util::setResponseJson($status[0],$status[1]);
       
    }

    public function pdfExtract($id_customer){

        return new ExtractCollection(Extract::getAllExtractsByCustomer($id_customer));
        
    }
}
