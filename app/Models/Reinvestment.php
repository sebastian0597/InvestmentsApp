<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reinvestment extends Model
{
    use HasFactory;
    protected $table = 'reinvestments';
    protected $fillable = [
        'id_customer',
        'id_investment',
        'amount',
        'reinvestment_date',
        'id_investment_type',
        'profitability_start_date',
        'registered_by',
    ];
}
