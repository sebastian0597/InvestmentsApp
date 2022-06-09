<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRol extends Model
{
    use HasFactory;
    protected $table = 'model_has_roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'model_type',
        'model_id',  
    ];


    public function rol()
    {   
        
        return $this->belongsTo(Rol::class, 'role_id', 'id');
    }
    
}
