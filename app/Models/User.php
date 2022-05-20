<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_rol',
        'personal_code'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   /* public static function roleText()
{   
    $texto='';
    switch ($this->id_rol) {
        case '1':
            $texto='Administrador';
            break;
        case '2':
                $texto='Cliente';
                break;
        case '3':
            $texto='Admin';
            break;
        default:
             $texto='Admin';
            break;
    }

    return $texto;
}*/

}
