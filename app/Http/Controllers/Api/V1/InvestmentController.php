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
        return new InvestmentResource(Investment::find($id));

    }

    public function showByCustomer($id_customer)
    {
        return new InvestmentCollection(Investment::getInvestmentsByIdCustomer($id_customer));

    }

    
    public function update(Request $request, $id)
    {
        $investment = DB::transaction(function () use($request, $id){

            $fields = $request->validate([

                'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'base_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'consignment_file' => 'required|string',
                'code_currency' => 'required|string',
                'id_payment_method' => 'required|numeric',
                'status' => 'required|numeric',
                'id_investment_type' => 'required|numeric',
                'document_number' => 'required|numeric',
                'updated_by' => 'required|numeric',
                
            ]);

            //$consignment_file=NULL;
            $consignment_file='Consignacion_2.pdf';
            if($request->hasFile("consignment_file")){
                $file=$request->file("consignment_file");
                
                $consignment_file = "rut_".$request->document_number.".".$file->guessExtension();
                $ruta = public_path("archivos/consiganciones/".$consignment_file);
                copy($file, $ruta);
            }

            $investment = Investment::find($id);
            
            $investment->code_currency = $fields['code_currency'];
            $investment->base_amount = $fields['base_amount'];
            $investment->amount = $fields['amount'];
            $investment->consignment_file = $consignment_file;
            $investment->id_payment_method = $fields['id_payment_method'];
            $investment->id_investment_type = $fields['id_investment_type'];
            //$investment->profitability_start_date = '';
            $investment->status = $fields['status'];
            //$investment->updated_by = $fields['updated_by'];
           
            $investment->update();

            return "Se ha actualizado la inversión correctamente.";
           
       }, 3); 

       return Util::setResponseJson(201, $investment);
               
    }

  
    public function destroy($id)
    {
        //
    }

    

   
}
