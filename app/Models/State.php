<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';


    public static function getStateByCountry($country_id){

        return State::where('country_id',$country_id)->get();

    }
}
