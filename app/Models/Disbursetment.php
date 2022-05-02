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
            ->select(DB::raw('count(*) as quantity, customers.id_customer_type, sum(disbursetments.value_consign) AS value_consign, SUBSTRING(disbursetments.created_at, 1,7) AS fecha'))
            //->where(DB::raw('SUBSTRING(disbursetments.created_at, 1,7)','=', '2022-04'))
            ->groupBy('customers.id_customer_type')
            ->get();
        
    }

    public static function getDisbursementsByParams($param){

        return Disbursetment::select('disbursetments.*')->join('customers', 'disbursetments.id_customer', '=', 'customers.id')
        ->where('disbursetments.id',$param)->orWhere('customers.document_number', $param)
        ->get();
    }




    public function getDoneAttribute(){
        
        return is_null($this->ind_done) == true ? 'Pendiente' :  'Desembolsado' ;
    
    }




    public function disbursementType()
    {   
        
        return $this->hasOne(DisbursementType::class, 'id', 'id_disbursement_type');
    }

    public function customer()
    {   
        
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    
}
