<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

use App\Utils\Util;

class DocumentController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index(){
       
        $customer = Customer::where('id_user', auth()->user()->id)->first();

        if($customer){
            $customer = new CustomerResource($customer);
            $customer = Util::setJSONResponseUniqueData($customer);
        }
        return view('clientes.documentos', compact('customer'));
    }
}
