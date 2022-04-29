<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'amount',
        'consignment_file',
        'code_currency',
        'other_currency',
        'id_payment_method',
        'investment_date',
        'id_investment_type',
        'profitability_start_date',
        'registered_by',
        'base_amount'
    ];

    public static function getTotalInvestmentCustomer($id_customer){

        return Investment::where('status', '1')->where('id_customer',$id_customer)->sum('amount');

    }

    public static function getTotalInvestmentCustomerByInvestmentType($id_customer, $investment_type){

        return Investment::where('status', '1')->where('id_customer',$id_customer)
        ->where('id_investment_type',$investment_type)->sum('amount');

    }

    public static function getInvestmentsByIdCustomer($id_customer){

        return Investment::where('status', '1')->where('id_customer',$id_customer)->get();

    }

    public static function getInvestmentsByParam($param){

        //return Investment::where('status', '1')->where('id',$param)->orWhere()->get();

        return Investment::select('investments.*')->join('customers', 'investments.id_customer', '=', 'customers.id')
                ->where('investments.status', 1)/*->where('investments.id',$param)*/->where('customers.document_number', $param)
                ->get();

    }


    //RELATIONS ELOQUENT

    public function customer(){

        return $this->belongsTo(Customer::class,'id_customer','id');
    } 

    public function paymentMethod(){

        return $this->hasOne(PaymentMethod::class,'id','id_payment_method');
    }

    public function investmentType(){

        return $this->hasOne(InvestmentType::class,'id','id_investment_type');
    }

    public function registeredBy(){

        return $this->hasOne(User::class,'id','registered_by');
    }

    public function getStatusTextAttribute(){
        $status;
        $status = $this->status == 1 ? "Activa" : "Desembolsada";
        return $status;

    }
}
