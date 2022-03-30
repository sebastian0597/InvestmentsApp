<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerType;

class ExtractController extends Controller
{
    public function index(){

        $extracts = CustomerType::getByStatus(1);
        return view('Admins.extractos', compact('extracts'));

    }

}
