<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

use App\Utils\Util;

class InvestmentController extends Controller
{
    public function index(){

        $customers = new CustomerCollection(Customer::where('status',1)->get());
        $customers = Util::setJSONResponse($customers);
        return view('Admins.inversiones', compact("customers"));

    }
}
