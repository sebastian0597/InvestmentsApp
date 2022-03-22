<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Investment;
use App\Models\Customer;
use App\Models\Extract;
use App\Http\Resources\V1\InvestmentResource;
use App\Http\Resources\V1\InvestmentCollection;

use App\Utils\Util;
use App\Utils\ProfitabilityDate;

use App\Http\Traits\InvestmentTrait;

class InvestmentController extends Controller
{
    use InvestmentTrait;
    
    public function index()
    {
        $fecha = ProfitabilityDate::create(2022,03,25);
        $fecha->addBussinessDays(2);
        dd($fecha->toDateString());

    }

    public function store(Request $request)
    {

        $investment = DB::transaction(function () use($request){

             // Using Trait method
            return $this->storeInvestment($request);
            
        }, 3); 
        
        return Util::setResponseJson(201, $investment);

    }

   
    public function show($id)
    {
        

    }

    public function showByCustomer($id_customer)
    {
        return new InvestmentCollection(Investment::getInvestmentsByIdCustomer($id_customer));

    }

    
    public function update(Request $request, $id)
    {
        
    }

  
    public function destroy($id)
    {
        //
    }


    public function setPercentajeByCustomerType(Request $request){

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

                DB::statement(" UPDATE investments I 
                INNER JOIN customers C ON C.id = I.id_customer 
                SET I.percentage_investment=?
                WHERE C.id_customer_type=? AND I.status=1",

                [$fields['percentage'],$fields['id_customer_type']]);

                $total_reinvested = Investment::getTotalInvestmentCustomerByInvestmentType($customer->id, 1);
                $total_invested = Investment::getTotalInvestmentCustomer($customer->id);
                
                $extract = Extract::create([
                    'id_customer' => $customer->id,
                    'total_disbursed' => 0,
                    'total_reinvested' => $total_reinvested,
                    'profitability_percentage' => $fields['percentage'],
                    'grand_total_invested' => $total_invested,
                    'registered_by' => 1,
                    'month' => date("m")

                ]);

                DB::statement("INSERT INTO extracts_details (id_extract, id_investment, created_at)
                SELECT ?, id, NOW() FROM investments I
                WHERE I.id_customer = ? AND I.status = 1
                ",[$extract->id,$customer->id]);


                return array(201, 'Se ha registrado el porcentaje de rentabilidad correctamente.');

            }else{

                return array(404, 'No se han encontrado inversiones para ese tipo de cliente.');
               
            }
           
        }, 3); 
        
        return Util::setResponseJson($status[0],$status[1]);
       
    }

    public function setPercentajeByNitCustomer(Request $request){

        $status = DB::transaction(function () use($request){
           
            $fields = $request->validate([

                'document_number' => 'required|string',
                'percentage' => 'required|numeric',
            ]);

            $customer = DB::table('customers')
             ->select('id', 'status')
             ->where('document_number', '=', $fields['document_number'])
             ->first();
           
            if($customer){

                DB::statement(" UPDATE investments I 
                INNER JOIN customers C ON C.id = I.id_customer 
                SET I.percentage_investment=?
                WHERE C.id=? AND I.status=1",

                [$fields['percentage'], $customer->id]);

                $total_reinvested = Investment::getTotalInvestmentCustomerByInvestmentType($customer->id, 1);
                $total_invested = Investment::getTotalInvestmentCustomer($customer->id);
                
                $extract = Extract::create([
                    'id_customer' => $customer->id,
                    'total_disbursed' => 0,
                    'total_reinvested' => $total_reinvested,
                    'profitability_percentage' => $fields['percentage'],
                    'grand_total_invested' => $total_invested,
                    'registered_by' => 1,
                    'month' => date("m")

                ]);

                DB::statement("INSERT INTO extracts_details (id_extract, id_investment, created_at)
                SELECT ?, id, NOW() FROM investments I
                WHERE I.id_customer = ? AND I.status = 1
                ",[$extract->id,$customer->id]);


                
                return array(201, 'Se ha registrado el porcentaje de rentabilidad correctamente.');

            }else{

                return array(404, 'No se han encontrado inversiones para este cliente.');
               
            }
           
        }, 3); 
        
        return Util::setResponseJson($status[0],$status[1]);
       
    }

   
}
