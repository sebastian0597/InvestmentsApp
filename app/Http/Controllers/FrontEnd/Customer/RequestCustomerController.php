<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\V1\RequestResource;
use App\Http\Resources\V1\RequestCollection;

use App\Models\CustomerRequest;
use App\Models\RequestType;

use App\Utils\Util;

class RequestCustomerController extends Controller
{
    public function index(){
       
        $requests = new RequestCollection(CustomerRequest::where('id_customer',16)->get());
        $requests = Util::setJSONResponseUniqueData($requests);
        $requests_types = RequestType::all();
       // dd($requests_types);
       
        //dd($customer);
        /*$documents_types = DocumentType::getByStatus(1);
        $economics_activities = EconomicActivity::getByStatus(1);
        $banks_accounts = BankAccount::getByStatus(1);
        $currencies = Currency::getByStatus(1);
        $payment_methods = PaymentMethod::getByStatus(1);
        $banks = Bank::getByStatus(1);
        $countries = Country::getByStatus(1);*/

        return view('clientes.solicitudes', compact('requests','requests_types'));
    }
}
