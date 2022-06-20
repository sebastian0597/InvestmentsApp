<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class QueryController extends Controller
{
    public function showStatesByCountry(Request $request, $country_id)
    {
        return State::getStateByCountry($country_id);
    }

}
