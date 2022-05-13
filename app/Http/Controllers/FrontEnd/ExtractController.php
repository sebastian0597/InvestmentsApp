<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerType;
use App\Models\Extract;
use App\Http\Resources\V1\ExtractCollection;
use App\Utils\Util; 

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
      
        return view('Pdfs.reporte_extracto', compact('extracts'));
        
    }

}
