<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    use HasFactory;
    protected $table = 'customer_types';

    public static function getByStatus($status){

        return CustomerType::where('status', $status)->get();
    }
}
