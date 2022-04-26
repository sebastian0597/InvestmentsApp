<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisbursementType extends Model
{
    use HasFactory;
    protected $table = 'disbursement_types';

    public static function getByStatus($status){

        return DisbursementType::where('status', $status)->get();

    }
}
