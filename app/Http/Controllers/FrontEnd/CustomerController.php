<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentType;
use App\Models\EconomicActivity;
use App\Models\Bank;
use App\Models\Currency;
use App\Models\PaymentMethod;


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
}
