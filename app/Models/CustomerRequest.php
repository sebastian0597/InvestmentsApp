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

    public function getRequestedAtAttribute(){

        return $this->created_at->diffForHumans();

    }

    public function getStatusTextAttribute(){
        $status;
        $status = $this->status == 1 ? "Nueva" : "Leída";
        return $status;

    }
}
