<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentType extends Model
{
    use HasFactory;
    protected $table = 'investments_types';

     public static function getByStatus($status){

        return InvestmentType::where('status', $status)->get();

    }
}
