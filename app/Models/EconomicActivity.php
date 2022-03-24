<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EconomicActivity extends Model
{
    use HasFactory;
    protected $table = 'economics_activities';

    public static function getByStatus($status){

        return EconomicActivity::where('status', $status)->get();

    }
}
