<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\Extract;
use App\Models\Investment;
use App\Models\Disbursetment;
use App\Http\Resources\V1\ExtractCollection;
use App\Utils\Util; 
use PDF;

class ExtractController extends Controller
{

    public function __construct()
    {   
    
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){

        $customer_types = CustomerType::getByStatus(1);
       
        return view('Admins.extractos', compact('customer_types'));

    }

    public function pdfExtract($id_customer){

        $extracts =  /*new ExtractCollection(*/Extract::getExtractByCustomer($id_customer)/*)*/;
        $extracts = json_encode($extracts);
        $extracts = json_decode($extracts, true);
     
        $customer = Customer::find($id_customer);
        $customer = json_encode($customer);
        $customer = json_decode($customer, true);
        
        $current_extract = Extract::where('id_customer', $id_customer)->where('month', date('m'))->first();
        $current_extract = json_encode($current_extract);
        $current_extract = json_decode($current_extract, true);

        $investments = Investment::where('id_customer', $id_customer)->get();
        $disbursetments = Disbursetment::where('id_customer', $id_customer)->where('ind_done', 1)->get();

        $capital_inicial=0;
        $rentabilidad_acumulada=0;
        $desembolsos_efectuados=0;
        $capital_neto=0;
       
        foreach($investments as $inv){$capital_inicial+=intval($inv->initial_amount);}
        foreach($disbursetments as $dis){$desembolsos_efectuados+=intval($dis->value_consign);}
        foreach($extracts as $ext){$rentabilidad_acumulada+=intval($ext['investment_return']);}
        
        $capital_neto=($capital_inicial+$rentabilidad_acumulada)-$desembolsos_efectuados;

        $pdf = PDF::loadView('Pdfs.extract', compact('extracts','customer', 'current_extract', 
        'capital_inicial', 'rentabilidad_acumulada', 'desembolsos_efectuados', 'capital_neto'))
        ->setPaper('a4', 'landscape')->stream('reporte_extractos.pdf');

        return $pdf;
    
    }

}
