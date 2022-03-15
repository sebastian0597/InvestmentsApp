<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'amount',
        'consignment_file',
        'id_currency',
        'other_currency',
        'id_payment_method',
        'investment_date'
    ];

}
