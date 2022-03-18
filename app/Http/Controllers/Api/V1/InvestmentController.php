<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Investment;

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
            //API conversor divisas
             //https://api.fastforex.io/fetch-multi?from=USD&to=COP&api_key=73306c96fe-5a91bbb373-r8ylp0

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
        //
    }

  
    public function destroy($id)
    {
        //
    }

   
}
