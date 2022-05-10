<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extract extends Model
{
    use HasFactory;
    protected $table = 'extracts';

    protected $fillable = [
        'id_customer',
        'total_disbursed',
        'total_reinvested',
        'profitability_percentage',
        'grand_total_invested',
        'registered_by',
        'status',
        'month'
    ];

    public static function getExtractByCustomerAndMonth($customer, $month) {

        return Extract::where('id_customer', $customer)->where('month', $month)->get();

    }

    public static function getExtractByCustomerAndStatus($customer) {

        return Extract::where('id_customer', $customer)->where('status', 1)->get();

    }

    public function extractDetail (){

        return $this->hasMany(ExtractDetail::class, 'id_extract', 'id');
    }

    public function customer (){

        return $this->belongsTo(Customer::class, 'id', 'id_customer');
    }
}
