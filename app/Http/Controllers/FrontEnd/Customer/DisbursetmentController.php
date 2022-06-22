<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Resources\V1\DisbursementResource;
use App\Http\Resources\V1\DisbursementCollection;

use App\Models\Disbursetment;
use App\Utils\Util;
use App\Models\Customer;

class DisbursetmentController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth');
        $this->middleware('customer');
    }

    public function index(){
       
        $customer = Customer::where('id_user', auth()->user()->id)->first();
        $disbursetments = array();

        if($customer){
            $disbursetments = new DisbursementCollection(Disbursetment::getDisbursementDoneByIdCustomer($customer->id));
            $disbursetments = Util::setJSONResponseUniqueData($disbursetments);
        }
       
        return view('Clientes.desembolsos', compact('disbursetments', 'customer'));
    }
}
