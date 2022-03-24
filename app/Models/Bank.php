<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'banks_account';

    public static function getByStatus($status){

        return Bank::where('status', $status)->get();

    }
    
}
