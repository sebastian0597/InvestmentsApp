<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $table = 'banks_account';

    public static function getByStatus($status){

        return BankAccount::where('status', $status)->get();

    }
}
