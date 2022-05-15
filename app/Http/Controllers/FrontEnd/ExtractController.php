<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerType;
use App\Models\Extract;
use App\Http\Resources\V1\ExtractCollection;
use App\Utils\Util; 
use PDF;

class ExtractController extends Controller
{
    public function index(){

        $customer_types = CustomerType::getByStatus(1);
       
        return view('Admins.extractos', compact('customer_types'));

    }

    public function pdfExtract($id_customer){

        $extracts =  /*new ExtractCollection(*/Extract::getExtractByCustomer($id_customer)/*)*/;

        $extracts = json_encode($extracts);
        $extracts = json_decode($extracts, true);

        $data = [
            'titulo' => 'Styde.net'
        ];
    
        $pdf = PDF::loadView('Pdfs.reporte_extracto', compact('extracts'))->stream('archivo.pdf');
       // return PDF::loadView('vista-pdf', $data)
        return $pdf;
        //return $pdf->download('archivo.pdf');
      
        //return view('Pdfs.reporte_extracto', compact('extracts'));
        
    }

}
