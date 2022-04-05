<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequest extends Model
{
    use HasFactory;
    protected $dates = ['request_date'];
    protected $table = 'requests';
    protected $fillable = [

        'id_customer',
        'request_date',
        'request_type',
        'description'

    ];


    //QUERIES
    public static function getRequestByDate($date){
        
        $from = date($date);
        $to = date($date);

        return CustomerRequest::whereBetween('request_date', [$from.' 00:00:00', $to.' 23:59:59'])->get();
    }

    /*ELOQUENT RELATIONS*/
    public function customer(){
        
        return $this->belongsTo(Customer::class, 'id_customer','id');
    }

    public function requesType(){
        
        return $this->belongsTo(RequestType::class, 'request_type','id');
    }

    public function userAttend(){

        return $this->belongsTo(User::class,'id_user_attends_request','id');
    }



    /*VIRTUAL ATRIBUTTES*/
    public function getDateRequestAttribute(){

        return substr($this->request_date, 0, 10);

    }

    public function getHourAttribute(){

        return date("g:i a", strtotime(substr($this->request_date, 11, 14)));

    }

    public function getRequestedAtAttribute(){

        return $this->created_at->diffForHumans();

    }

    public function getStatusTextAttribute(){
        $status;
        $status = $this->status == 1 ? "Nueva" : "Respondida";
        return $status;

    }

    public function getShortDescriptionAttribute(){
   
        return substr($this->description, 0, 80); 

    }

}
