<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\V1\ExtractResource;
use App\Http\Resources\V1\ExtractCollection;

use App\Models\Extract;
use App\Utils\Util;
use App\Models\Customer;

class ExtractController extends Controller
{
    public function __construct()
    {   
    
        $this->middleware('auth');
        $this->middleware('customer');
    }
    
    public function index(){
        $customer = Customer::where('id_user', auth()->user()->id)->first();
        $extracts = array();

        if($customer){

            $extracts = new ExtractCollection(Extract::getExtractByIdCustomer($customer->id));
            $extracts = Util::setJSONResponseUniqueData($extracts);
        }
        return view('clientes.extractos', compact('extracts', 'customer'));
    }

}
