<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request){

        $fields =  $this->validateLogin($request);
        $user = User::where('email', $fields['email'])
        ->where('personal_code', $fields['personal_code'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            
            /*Como el usuario que intenta hacer login no ingresa los datos correctos
            el sistema no encuentra el usuario, por lo tanto, se vuelve a buscar el usuario
            con un or, para hacer la busqueda con el codigo personal o el correo. */
            $user = User::where('email', $fields['email'])
            ->orWhere('personal_code', $fields['personal_code'])->first();
            
            if(!is_null($user->blocked_date)){

                $this->validateBlockedTime($user->blocked_date, $user);
               
            }

            if(!is_null($user)){

                if($user->failed_login_attempts<3){
                    /*En caso de que las credenciales sean invalidas, se va sumando al numero intentos fallidos
                    un intento más*/
                    $user->failed_login_attempts = intval($user->failed_login_attempts)+1;
                    $user->save();
                    return $this->setResponseJson(401,'Credenciales inválidas, revise que el correo, contraseña o que el código sea el correcto.');
                    

                }else if($user->failed_login_attempts==3 && is_null($user->time_blocked)){

                    $user->ind_blocked = 1;
                    $user->time_blocked = 30;
                    $user->blocked_date = date('Y-m-d h:i:s');
                    $user->save();
                    return $this->setResponseJson(401,'El usuario se ha bloqueado por 30 minutos.');
             
                }else if($user->failed_login_attempts==3 && $user->time_blocked>0){

                    return $this->setResponseJson(401,'El usuario se ha bloqueado temporalmente, intente más tarde.');

                }else if($user->failed_login_attempts>=3 && $user->time_blocked==0){

                    $user->failed_login_attempts = intval($user->failed_login_attempts)+1;
                    $user->save();

                    if($user->failed_login_attempts>=6){

                        return $this->banningUser($user);

                    }else{

                        return $this->setResponseJson(401,'Credenciales inválidas, revise que el correo, contraseña o que el código sea el correcto.');
                    }
                    
                }
                
            }else{
                
                return $this->setResponseJson(401,'El usuario no se encuentra registrado.');
            }
           

        }else if($user->status <> 1){

            return $this->setResponseJson(402,'El usuario se encuentra inactivo.');
          
        }else if($user->ind_blocked == 1 && !is_null($user->time_blocked)){

            return $this->setResponseJson(402,'Usuario bloqueado temporalmente.');
            
        }else if($user->ind_banned == 1){

            return $this->setResponseJson(402,'Usuario bloqueado por múlitples intentos fallidos, por favor comuníquese con un administrador.');
          
        }else{

            $user->ind_banned=NULL;
            $user->ind_blocked=NULL;
            $user->time_blocked=NULL;
            $user->blocked_date=NULL;
            $user->banned_date=NULL;
            $user->failed_login_attempts=NULL;
            $user->save();

            $token = $user->createToken('myapptoken')->plainTextToken;
            return $this->setResponseJson(200,$user, $token);
           
        }

       
    }
    
    
    public function  setResponseJson($status,$message,$token=""){
        
        return response()->json([
            'status'=> $status,
            'message' => $message,
            'token' => $token
        ]);

    }

    public function banningUser($user){

        $user->ind_banned = 1;
        $user->banned_date = date('Y-m-d h:i:s');
        $user->save();
        return $this->setResponseJson(401,'Usuario bloqueado por el sistema, debido a que se detectó multiples intentos fallidos de inicio de sesion, para desbloquearlo, por favor comunicarse con un administrador.');
       
    }

    public function validateLogin(Request $request){
        
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'personal_code' => 'required|string'
        ]);

       return $fields;
    }

    public function validateBlockedTime($date, $user){

         //convertimos la fecha 1 a objeto Carbon
         $carbon1 = new Carbon($date);
         //convertimos la fecha 2 a objeto Carbon
         $carbon2 = new Carbon(date('Y-m-d h:i:s'));
         //de esta manera sacamos la diferencia en minutos
         $minutesDiff=$carbon1->diffInMinutes($carbon2);
         
         if($minutesDiff >= $user->time_blocked){
             $user->time_blocked=0;
             $user->ind_blocked=NULL;
             $user->blocked_date=NULL;
             $user->save();
         }

        return $minutesDiff;

    }

    public function logout(Request $request){

        auth()->user()->tokens()->delete();
        return response()->json([            
            'message' => "La sesión se ha finalizado.",

        ]);
    }

}
