<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Disbursetment extends Model
{
    use HasFactory;
    protected $table = 'disbursetments';

    protected $fillable = [
        'id_disbursement_type',
        'id_customer',
        'value_consign',
        'monthly_return',
        'month',
        'ind_done',
        'disbursetment_file'
    ];

    public static function getDisbursement($date){

       // $date =  "'$date'";
      
        return DB::table('disbursetments')
            ->join('customers', 'customers.id', '=', 'disbursetments.id_customer')
            ->select(DB::raw('count(*) as cantidad, customers.id_customer_type, sum(disbursetments.value_consign) AS value_consign, SUBSTRING(disbursetments.created_at, 1,7) AS fecha'))
            //->where(DB::raw('SUBSTRING(disbursetments.created_at, 1,7)','=', '2022-04'))
            ->groupBy('customers.id_customer_type')
            ->get();
        
        

    }
}
