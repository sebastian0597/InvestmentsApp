<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'id_user',
        'admin_code',
    ];

    public function rol(){

        return $this->hasOne(Rol::class,'id','id_rol');
    }


    public function getStatusTextAttribute(){
       
        $status = $this->status == 1 ? "Activo" : "Inactivo";
        return $status;

    }


}
