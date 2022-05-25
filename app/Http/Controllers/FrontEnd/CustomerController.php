<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentType;
use App\Models\EconomicActivity;
use App\Models\BankAccount;
use App\Models\Bank;
use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Models\Customer;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

use App\Utils\Util;

class CustomerController extends Controller
{   

    public function __construct()
    {   
    
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function create(Request $request){

        $documents_types = DocumentType::getByStatus(1);
        $economics_activities = EconomicActivity::getByStatus(1);
        $banks_accounts = BankAccount::getByStatus(1);
        $currencies = Currency::getByStatus(1);
        $payment_methods = PaymentMethod::getByStatus(1);
        $banks = Bank::getByStatus(1);
        $countries = Country::getByStatus(1);
          
        return view('Admins.crear_cliente', compact('documents_types', 'economics_activities','banks_accounts','currencies','payment_methods', 'banks', 'countries'));
    }

    public function index(){
        
        $customers = new CustomerCollection(Customer::all());
        $customers = Util::setJSONResponse($customers);
      
        return view('Admins.clientes',compact('customers'));
    }

    public function edit($id_customer){
       
        $customer = new CustomerResource(Customer::find($id_customer));
        $customer = Util::setJSONResponseUniqueData($customer);
        $documents_types = DocumentType::getByStatus(1);
        $economics_activities = EconomicActivity::getByStatus(1);
        $banks_accounts = BankAccount::getByStatus(1);
        $currencies = Currency::getByStatus(1);
        $payment_methods = PaymentMethod::getByStatus(1);
        $banks = Bank::getByStatus(1);
        $countries = Country::getByStatus(1);

        return view('Admins.editar_cliente', compact('documents_types', 'economics_activities','banks_accounts','currencies','payment_methods', 'banks', 'countries', 'customer'));
    }
    
}

