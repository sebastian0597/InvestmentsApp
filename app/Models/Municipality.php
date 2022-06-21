<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $table = 'municipalities';

    public static function getMunicipalityByState($state_name){

        return Municipality::select('municipalities.id as id', 'municipalities.name as name')->join('states', 'states.id', '=', 'municipalities.state_id')->where('states.name',$state_name)->get();

    }
}
