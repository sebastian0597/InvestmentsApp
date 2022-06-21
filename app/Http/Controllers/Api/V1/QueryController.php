<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Municipality;

class QueryController extends Controller
{
    public function showStatesByCountry(Request $request, $country_id)
    {
        return State::getStateByCountry($country_id);
    }

    public function showMunicipalityByState(Request $request, $state_id)
    {
        return Municipality::getMunicipalityByState($state_id);
    }

    

}
