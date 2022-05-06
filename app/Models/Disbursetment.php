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
        'date_create',
        'ind_done',
        'disbursetment_file'
    ];

    public static function getDisbursement($date){
      
        return DB::table('disbursetments')
            ->select(DB::raw('count(*) as quantity, id_disbursement_type, sum(value_consign) AS value_consign, SUBSTRING(date_disbursement, 1,7)'))
            ->where('ind_done', 1)
            ->whereRaw("SUBSTRING(date_disbursement, 1,7) = '$date' ")
            ->groupBy('id_disbursement_type')
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
