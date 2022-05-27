<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\V1\RequestResource;
use App\Http\Resources\V1\RequestCollection;

use App\Models\CustomerRequest;
use App\Models\RequestType;
use App\Models\Customer;
use App\Utils\Util;

class RequestCustomerController extends Controller
{

    public function __construct()
    {   
    
        $this->middleware('auth');
        $this->middleware('customer');
    }
    
    public function index(){
        $customer = Customer::where('id_user', auth()->user()->id)->first();
        $requests = new RequestCollection(CustomerRequest::where('id_customer',$customer->id)->get());
        $requests = Util::setJSONResponseUniqueData($requests);
        $requests_types = RequestType::all();
   
        return view('clientes.solicitudes', compact('requests','requests_types'));
    }
}
