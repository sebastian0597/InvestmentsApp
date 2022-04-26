<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisbursementType;
use App\Models\CustomerType;

class DisbursementController extends Controller
{
    public function index(){
         
        $disbursement_types = DisbursementType::getByStatus(1);
        $customer_types = CustomerType::getByStatus(1);
        return view('Admins.desembolsos', compact('disbursement_types', 'customer_types')); 
    }
}
