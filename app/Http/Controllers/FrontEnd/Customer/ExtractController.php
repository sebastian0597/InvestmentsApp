<?php

namespace App\Http\Controllers\FrontEnd\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\V1\ExtractResource;
use App\Http\Resources\V1\ExtractCollection;

use App\Models\Extract;
use App\Utils\Util;

class ExtractController extends Controller
{
    public function index(){
       
        $extracts = new ExtractCollection(Extract::getExtractByIdCustomer(16));
        $extracts = Util::setJSONResponseUniqueData($extracts);
        //dd($extracts);
        return view('clientes.extractos', compact('extracts'));
    }

}
