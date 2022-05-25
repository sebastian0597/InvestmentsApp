<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisbursementType;
use App\Models\Disbursetment;
use App\Models\CustomerType;
use App\Models\Customer;

use App\Http\Resources\V1\DisbursementResource;
use App\Http\Resources\V1\DisbursementCollection;

use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

use App\Utils\Util;

class DisbursementController extends Controller
{

    public function __construct()
    {   
    
        $this->middleware('auth');
        $this->middleware('admin');
    }

    
    public function index(){
         
        $disbursement_types = DisbursementType::getByStatus(1);
        $customer_types = CustomerType::getByStatus(1);
        return view('Admins.desembolsos', compact('disbursement_types', 'customer_types')); 
    }

    public function edit($id_disbursetment){

        $disbursement = new DisbursementResource(Disbursetment::find($id_disbursetment));
        $customer = new CustomerResource(Customer::find($disbursement->id_customer));
       
        $disbursement = Util::setJSONResponseUniqueData($disbursement);
        $customer = Util::setJSONResponseUniqueData($customer);

        return view('Admins.editar_desembolsos', compact('disbursement', 'customer')); 
    }
    
}
