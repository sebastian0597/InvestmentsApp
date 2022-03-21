<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursetment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_disbursement_type',
        'id_customer',
        'value_consign',
        'monthly_return',
        'ind_done',
        'disbursetment_file'
    ];
}
