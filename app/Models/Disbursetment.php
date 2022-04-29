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
        'month',
        'ind_done',
        'disbursetment_file'
    ];

    public static function getDisbursement(){

        /*SELECT COUNT(*) AS cantidad, C.id_customer_type, SUM(D.value_consign) AS value_consign FROM disbursetments D
        INNER JOIN customers C ON C.id = D.id_customer
        GROUP BY C.id_customer_type*/
    }
}
