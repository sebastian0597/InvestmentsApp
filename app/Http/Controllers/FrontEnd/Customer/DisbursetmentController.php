<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Resources\V1\DisbursementResource;
use App\Http\Resources\V1\DisbursementCollection;

use App\Models\Disbursetment;
use App\Utils\Util;

class DisbursetmentController extends Controller
{
    public function index(){
       
        $disbursetments = new DisbursementCollection(Disbursetment::getDisbursementByIdCustomer(16));
        $disbursetments = Util::setJSONResponseUniqueData($disbursetments);
        
        return view('clientes.desembolsos', compact('disbursetments'));
    }
}
