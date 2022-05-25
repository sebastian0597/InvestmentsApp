<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Models\InvestmentType;
use App\Models\Investment;

use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

use App\Http\Resources\V1\InvestmentResource;
use App\Http\Resources\V1\InvestmentCollection;

use App\Utils\Util;

class InvestmentController extends Controller
{

    public function __construct()
    {   
    
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){

        $customers = new CustomerCollection(Customer::where('status',1)->get());
        $customers = Util::setJSONResponse($customers);
        return view('Admins.inversiones', compact("customers"));
    }

    public function create($id_customer){

        $customer = new CustomerResource(Customer::find($id_customer));
        $customer = Util::setJSONResponseUniqueData($customer);
        
        $investments_types = InvestmentType::getByStatus(1);
        $currencies = Currency::getByStatus(1);
        $payment_methods = PaymentMethod::getByStatus(1);

        return view('Admins.crear_inversion', compact('currencies','payment_methods','customer','investments_types'));

    }

    public function edit($id_investment)
    {
       
        $investment = new InvestmentResource(Investment::find($id_investment));
        $customer = new CustomerResource(Customer::find($investment->id_customer));
       
        $investment = Util::setJSONResponseUniqueData($investment);
        $customer = Util::setJSONResponseUniqueData($customer);
        
        $investments_types = InvestmentType::getByStatus(1);
        $currencies = Currency::getByStatus(1);
        $payment_methods = PaymentMethod::getByStatus(1);

        return view('Admins.editar_inversion', compact('currencies','payment_methods','customer','investments_types', 'investment'));
    }
}
