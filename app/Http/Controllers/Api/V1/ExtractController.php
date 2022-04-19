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
    public function show(Extract $extract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Extract  $extract
     * @return \Illuminate\Http\Response
     */
    public function edit(Extract $extract)
    {
        //
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
                
                //Se usa la función de Investment Trait
                $this->setPercentage($fields['percentage'], $customer->id);

                $total_reinvested = Investment::getTotalInvestmentCustomerByInvestmentType($customer->id, 1);
                $total_invested = Investment::getTotalInvestmentCustomer($customer->id);
                
                $arr_extract['id_customer'] = $customer->id;
                $arr_extract['total_disbursed'] = 0;
                $arr_extract['total_reinvested'] = $total_reinvested;
                $arr_extract['profitability_percentage'] = $fields['percentage'];
                $arr_extract['grand_total_invested'] = $total_invested;
                $arr_extract['registered_by'] = 1;
                $arr_extract['month'] = date("m");
               
                
                //Se usa la función de Extract Trait
                $extract = $this->storeExtract($arr_extract);
                              
                $investments = Investment::getInvestmentsByIdCustomer($customer->id);
                $total_investment_return=0;

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
                    $arr_extract_details['real_profitability_percentage'] = $real_profitability_percentage;
                    $arr_extract_details['investment_amount'] = $investment->amount;
                    $arr_extract_details['investment_return'] = $investment_return;
                    
                    //Se usa la función de Extract Trait
                    $this->storeExtractDetail($arr_extract_details);
                    
                    $total_investment_return+=$investment_return;
                }

                $extract->total_profitability = $total_investment_return;
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

            $customer = DB::table('customers')
             ->select(DB::raw('id, status'))
             ->where('id_customer_type', '=', $fields['id_customer_type'])
             ->first();

            if($customer){

                 //Se usa la función de Investment Trait
                 $this->setPercentage($fields['percentage'], $customer->id);

                /*DB::statement("UPDATE investments I 
                INNER JOIN customers C ON C.id = I.id_customer 
                SET I.percentage_investment=?
                WHERE C.id_customer_type=? AND I.status=1",

                [$fields['percentage'],$fields['id_customer_type']]);*/

                $total_reinvested = Investment::getTotalInvestmentCustomerByInvestmentType($customer->id, 1);
                $total_invested = Investment::getTotalInvestmentCustomer($customer->id);
                
                $arr_extract['id_customer'] = $customer->id;
                $arr_extract['total_disbursed'] = 0;
                $arr_extract['total_reinvested'] = $total_reinvested;
                $arr_extract['profitability_percentage'] = $fields['percentage'];
                $arr_extract['grand_total_invested'] = $total_invested;
                $arr_extract['registered_by'] = 1;
                $arr_extract['month'] = date("m");

                //Se usa la función de Extract Trait
                $extract = $this->storeExtract($arr_extract);

                /*$extract = Extract::create([
                    'id_customer' => $customer->id,
                    'total_disbursed' => 0,
                    'total_reinvested' => $total_reinvested,
                    'profitability_percentage' => $fields['percentage'],
                    'grand_total_invested' => $total_invested,
                    'registered_by' => 1,
                    'month' => date("m")
                ]);*/

                /*DB::statement("INSERT INTO extracts_details (id_extract, id_investment, created_at)
                SELECT ?, id, NOW() FROM investments I
                WHERE I.id_customer = ? AND I.status = 1
                ",[$extract->id,$customer->id]);*/
                
                $investments = Investment::getInvestmentsByIdCustomer($customer->id);
                $total_investment_return=0;

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
                    $arr_extract_details['real_profitability_percentage'] = $real_profitability_percentage;
                    $arr_extract_details['investment_amount'] = $investment->amount;
                    $arr_extract_details['investment_return'] = $investment_return;
                    
                    //Se usa la función de Extract Trait
                    $this->storeExtractDetail($arr_extract_details);
                    
                    $total_investment_return+=$investment_return;
                }

                $extract->total_profitability = $total_investment_return;
                $extract->save();

                return array(201, 'Se ha registrado el porcentaje de rentabilidad correctamente.');

            }else{

                return array(404, 'No se han encontrado inversiones para ese tipo de cliente.');     
            }
           
        }, 3); 
        
        return Util::setResponseJson($status[0],$status[1]);
       
    }
}
