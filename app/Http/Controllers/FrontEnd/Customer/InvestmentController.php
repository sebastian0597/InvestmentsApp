<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\V1\InvestmentResource;
use App\Http\Resources\V1\InvestmentCollection;

use App\Models\Investment;
use App\Utils\Util;
use App\Models\Customer;

class InvestmentController extends Controller
{

    public function __construct()
    {   
    
        $this->middleware('auth');
        $this->middleware('customer');
    }
    
    public function index(){
        $customer = Customer::where('id_user', auth()->user()->id)->first();
        $investments = new InvestmentCollection(Investment::getAllInvestmentsByIdCustomer($customer->id));
        $investments = Util::setJSONResponseUniqueData($investments);
        
        return view('clientes.inversiones', compact('investments'));
    }
}
