<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //
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
