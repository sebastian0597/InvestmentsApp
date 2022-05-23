<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\V1\InvestmentResource;
use App\Http\Resources\V1\InvestmentCollection;

use App\Models\Investment;
use App\Utils\Util;

class InvestmentController extends Controller
{
    public function index(){
       
        $investments = new InvestmentCollection(Investment::getAllInvestmentsByIdCustomer(16));
        $investments = Util::setJSONResponseUniqueData($investments);
        

        return view('clientes.inversiones', compact('investments'));
    }
}
