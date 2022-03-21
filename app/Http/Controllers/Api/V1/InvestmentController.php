<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Investment;
use App\Models\Customer;

use App\Http\Resources\V1\InvestmentResource;
use App\Http\Resources\V1\InvestmentCollection;

use App\Utils\Util;

use App\Http\Traits\InvestmentTrait;

class InvestmentController extends Controller
{
    use InvestmentTrait;
    
    public function index()
    {
        //
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
             ->get();

           
            if(count($customer)>0){

                DB::statement(" UPDATE investments I 
                INNER JOIN customers C ON C.id = I.id_customer 
                SET I.percentage_investment=?
                WHERE C.id_customer_type=?",

                [$fields['percentage'],$fields['id_customer_type']]);
                return array(201, 'Se ha registrado el porcentaje de rentabilidad correctamente.');

            }else{

                return array(404, 'No se han encontrado inversiones para ese tipo de cliente.');
               
            }
           
        }, 3); 
        
        return Util::setResponseJson($status[0],$status[1]);
       
    }

    public function setPercentajeByIdCustomer(Request $request){

        $status = DB::transaction(function () use($request){
           
            $fields = $request->validate([

                'id_customer' => 'required|numeric',
                'percentage' => 'required|numeric',
            ]);

            $customer =  Customer::find($fields['id_customer']);

           
            if($customer){

                DB::statement(" UPDATE investments I 
                INNER JOIN customers C ON C.id = I.id_customer 
                SET I.percentage_investment=?
                WHERE C.id=?",

                [$fields['percentage'],$fields['id_customer']]);
                return array(201, 'Se ha registrado el porcentaje de rentabilidad correctamente.');

            }else{

                return array(404, 'No se han encontrado inversiones para este cliente.');
               
            }
           
        }, 3); 
        
        return Util::setResponseJson($status[0],$status[1]);
       
    }

   
}
