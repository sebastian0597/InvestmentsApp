<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

use App\Models\Customer;
use App\Utils\Util;

class ProfileController extends Controller
{

    public function __construct()
    {   
    
        $this->middleware('auth');
        $this->middleware('customer');
    }
    
    public function index(){
        $customer = Customer::where('id_user', auth()->user()->id)->first();
        $customer = new CustomerResource(Customer::find($customer->id));
        $customer = Util::setJSONResponseUniqueData($customer);
        //dd($customer);
        /*$documents_types = DocumentType::getByStatus(1);
        $economics_activities = EconomicActivity::getByStatus(1);
        $banks_accounts = BankAccount::getByStatus(1);
        $currencies = Currency::getByStatus(1);
        $payment_methods = PaymentMethod::getByStatus(1);
        $banks = Bank::getByStatus(1);
        $countries = Country::getByStatus(1);*/

        return view('clientes.perfil', compact('customer'));
    }
}
