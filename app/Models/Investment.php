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
        'registered_by',
        'base_amount'
    ];

    public function getTotalInvestmentCustomer($id_customer){

        return Investment::where('status', '1')->where('id_customer',$id_customer)->sum('amount');

    }

    public function getInvestmentsByIdCustomer($id_customer){

        return Investment::where('status', '1')->where('id_customer',$id_customer)->get();

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
