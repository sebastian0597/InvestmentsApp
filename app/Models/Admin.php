<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
    ];

    public function model_rol(){

       return $this->hasOne(ModelHasRol::class, 'model_id', 'id');
    }


    /*public function getStatusTextAttribute(){
       
        $status = $this->status == 1 ? "Activo" : "Inactivo";
        return $status;

    }*/


}
