<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'last_name',
        'document_number',
        'phone',
        'address',
        'city',
        'department',
        'country',
        'file_document',
        'description_ind',
        'file_rut',
        'business',
        'position_business',
        'antique_bussiness',
        'type_contract',
        'work_certificate',
        'pension_fund',
        'especification_other',
        'account_number',
        'account_type',
        'bank_name',
        'account_certificate',
        'document_third',
        'name_third',
        'letter_authorization_third',
        'kinship_third',
        'rut_third',
        'id_document_type',
        'id_economic_activity',
        'id_bank_account',
        'id_customer_type',
        'registered_by'

    ];

    //QUERIES
    public static function searchCustomerByParams($param){    
        
        $customer = Customer::where('status',1)->where('name','LIKE','%'.$param.'%')
        ->orWhere('last_name','LIKE','%'.$param.'%')->orWhere('phone',$param)
        ->orWhere('account_number',$param)->orWhere('document_number', $param)->get();
        
        return $customer;
    }

    public static function searchCustomerByParamsAndCustomerType($param, $customerType){    
        
        $customer = Customer::where('status',1)
        ->where('id_customer_type', $customerType)
        ->where('document_number', $param)->first();
        
        return $customer;
    }

    public static function getCustomersByType($id_customer_type) {

        return Customer::where('id_customer_type', $id_customer_type)->where('status', 1)->get();
        
    }

    public static function getKPICustomer($date){
        $mes = $date;
        $mes = strtotime($mes);
        $mes = date("m", $mes);
      
        return DB::table("customers")
        ->select(DB::raw("COUNT(*) AS cantidad, status, id_customer_type, sum((SELECT SUM(amount) FROM investments 
        WHERE (status=1 OR status=2) AND id_customer = customers.id AND investment_date LIKE '%$date%')) 
        AS inversiones, sum((SELECT SUM(total_profitability) FROM extracts WHERE extracts.id_customer = customers.id 
        AND extracts.month LIKE '$mes')) AS total_rentabilidad, sum((SELECT SUM(total_disbursed) FROM extracts WHERE extracts.id_customer = customers.id 
        AND extracts.month LIKE '$mes')) AS total_disbursed"))
        ->groupByRaw("customers.status, customers.id_customer_type")
        ->get();



    }

    
    //VIRTUAL attributes
    public function getStatusTextAttribute(){
        
        $status = $this->status == 1 ? "Activo" : "Inactivo";
        return $status;

    }


    //RELATIONS Eloquent
    public function documentType(){

        return $this->hasOne(DocumentType::class, 'id','id_document_type');
    }

    public function economicActivity(){

        return $this->hasOne(EconomicActivity::class,'id','id_economic_activity');
    }

    public function bank(){

        return $this->hasOne(BankAccount::class, 'id','id_bank_account',);
    }

    public function customerType(){

        return $this->hasOne(CustomerType::class,'id','id_customer_type');
    }

    public function user(){

        return $this->hasOne(User::class,'id','id_user');
    }

    public function investsments()
    {   
     
        return $this->hasMany(Investment::class, 'id_customer', 'id')->where('investments.status', '=', 1);
    }

}
