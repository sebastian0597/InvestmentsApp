<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\Extract;
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
       
        $pdf = PDF::loadView('Pdfs.reporte_extracto', compact('extracts','customer'))->stream('archivo.pdf');
       // return PDF::loadView('vista-pdf', $data)
        return $pdf;
        //return $pdf->download('archivo.pdf');
      
        //return view('Pdfs.reporte_extracto', compact('extracts'));
        
    }

}
