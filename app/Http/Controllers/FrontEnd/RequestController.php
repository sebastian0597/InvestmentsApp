<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CustomerRequest;
use App\Http\Resources\V1\RequestResource;
use App\Http\Resources\V1\RequestCollection;

class RequestController extends Controller
{
    public function index(){

        $request = new RequestCollection(CustomerRequest::where('status',1)->get());
        

        $request = json_encode($request);
        $request = json_decode($request, true);
      
        return view('Admins.solicitudes', compact('request'));

    }
}
