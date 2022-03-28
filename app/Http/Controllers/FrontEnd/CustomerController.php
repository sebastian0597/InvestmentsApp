<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentType;
use App\Models\EconomicActivity;
use App\Models\Bank;
use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Models\Customer;

use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

class CustomerController extends Controller
{   

    public function create(){
       
        $documents_types = DocumentType::getByStatus(1);
        $economics_activities = EconomicActivity::getByStatus(1);
        $banks_accounts = Bank::getByStatus(1);
        $currencies = Currency::getByStatus(1);
        $payment_methods = PaymentMethod::getByStatus(1);
                        
        return view('Admins.crear_cliente', compact('documents_types', 'economics_activities','banks_accounts','currencies','payment_methods'));
    }

    public function index(){
        
        $customer = new CustomerCollection(Customer::where('status',1)->get());
        $customer = json_encode($customer);
        $customer = json_decode($customer, true);
        
        return view('Admins.clientes')->with('customers', $customer);

    }
}
