<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredentialsMailable;
use Auth;
use App\Models\User;
use App\Utils\Util;

class LoginController extends Controller

{

    public function login(Request $request){

        //$fields =  Util::validateLogin($request);
        $email = $request->email;
        $password = $request->password;
        $personal_code = $request->personal_code;

        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'personal_code' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])
        ->where('personal_code', $fields['personal_code'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            
            /*Como el usuario que intenta hacer login no ingresa los datos correctos
            el sistema no encuentra el usuario, por lo tanto, se vuelve a buscar el usuario
            con un or, para hacer la busqueda con el codigo personal o el correo. */
            $user = User::where('email', $fields['email'])
            ->orWhere('personal_code', $fields['personal_code'])->first();
            
            if(!is_null($user) && !is_null($user->blocked_date)){

                Util::validateBlockedTime($user->blocked_date, $user);
               
            }

            if(!is_null($user)){

                if($user->failed_login_attempts<3){
                    /*En caso de que las credenciales sean invalidas, se va sumando al numero intentos fallidos
                    un intento más*/
                    $user->failed_login_attempts = intval($user->failed_login_attempts)+1;
                    $user->save();
                    return Util::setResponseJson(401,'Credenciales inválidas, revise que el correo, contraseña o que el código sea el correcto.');
                    

                }else if($user->failed_login_attempts==3 && is_null($user->time_blocked)){

                    $user->ind_blocked = 1;
                    $user->time_blocked = 30;
                    $user->blocked_date = date('Y-m-d h:i:s');
                    $user->save();
                    return Util::setResponseJson(401,'El usuario se ha bloqueado por 30 minutos.');
             
                }else if($user->failed_login_attempts==3 && $user->time_blocked>0){

                    return Util::setResponseJson(401,'El usuario se ha bloqueado temporalmente, intente más tarde.');

                }else if($user->failed_login_attempts>=3 && $user->time_blocked==0){

                    $user->failed_login_attempts = intval($user->failed_login_attempts)+1;
                    $user->save();

                    if($user->failed_login_attempts>=6){

                        return Util::banningUser($user);

                    }else{

                        return Util::setResponseJson(401,'Credenciales inválidas, revise que el correo, contraseña o que el código sea el correcto.');
                    }
                    
                }
                
            }else{
                
                return Util::setResponseJson(401,'El usuario no se encuentra registrado.');
            }
           

        }else{

            if(!is_null($user) && !is_null($user->blocked_date)){

                Util::validateBlockedTime($user->blocked_date, $user);
               
            }

            if($user->status <> 1){

                return Util::setResponseJson(402,'El usuario se encuentra inactivo.');
          
            }else if($user->ind_blocked == 1 && !is_null($user->time_blocked)){

                return Util::setResponseJson(402,'Usuario bloqueado temporalmente, por favor intente más tarde.');
                
            }else if($user->ind_banned == 1){

                return Util::setResponseJson(402,'Usuario bloqueado por múltiples intentos fallidos, por favor comuníquese con un administrador.');
            
            }else{

                
                if (Auth::attempt(['email' => $fields['email'], 'password' => $fields['password'], 'status' => 1])) {
                        
                    $user->ind_banned=NULL;
                    $user->ind_blocked=NULL;
                    $user->time_blocked=NULL;
                    $user->blocked_date=NULL;
                    $user->banned_date=NULL;
                    $user->failed_login_attempts=NULL;
                    $user->save();

                    auth()->loginUsingId($user->id);
                    if($user->id_rol == 2){

                        $user->start_sesion_date = Util::getCurrentDate();
                        $user->finish_sesion_date = Util::getDateHourMinutes(30);
                        $user->save();

                    }else{

                        $user->start_sesion_date = Util::getCurrentDate();
                        $user->finish_sesion_date = Util::getDateHourMinutes(15);
                        $user->save();
                    }
                    $token = $user->createToken('myapptoken')->plainTextToken;

                    return Util::setResponseJson(200, auth()->user() , $token);

                }
   
            }
        }
       
    }


    public function resetPassword(Request $request){

        $fields = $request->validate([
            'personal_code' => 'required|string'
        ]);

        $user = User::where('personal_code', $fields['personal_code'])->first();

        if(!is_null($user) && $user->status ==1){
           $password = Util::generatePassword();
           $user->password =bcrypt($password);
           $user->save();

           $data["email"] =  $user->email;
           $data["title"] = "Reestablecimiento de contraseña";
           $data["code"] = $user->personal_code; 
           $data["password"] = $password;
           $data["name"] = $user->name;
           
           $mail = new CredentialsMailable($data);
           Mail::to($data["email"])->send($mail);

           return Util::setResponseJson(200,"Se ha reestablecido la contraseña, por favor revise su correo.");
           
        }else if(!is_null($user) && $user->status <> 1){

            return Util::setResponseJson(401,"El usuario al que se intenta reestablecer la contraseña se encuentra inactivo.");

        }else{
            return Util::setResponseJson(401,"El código ingresado no se encuentra registrado en el sistema.");
        }

    }

    public function changePassword(Request $request){

        $fields = $request->validate([
            'id_user' => 'required',
            'password' => 'required|string',
            'password_confirm' => 'required|string'
        ]);
        
        if($fields['password'] == $fields['password_confirm'] ){

            $user = User::find($fields['id_user']);

            $user->password = bcrypt($fields['password']);
            $user->ind_first_login = 0;
            $user->update();
            return Util::setResponseJson(200,"Se ha cambiado la contraseña correctamente.");

        }else{

            return Util::setResponseJson(401,"Las contraseñas ingresadas no coninciden.");

        }

    }
    

    public function logout(Request $request){

        Auth::logout();
        return redirect('login');
    }

    public function validateSesionTime(Request $request){
        $fields = $request->validate([
            'id_user' => 'required',
        ]);

        $id_user = $fields['id_user'];
        $user = User::find($id_user);

        $finish_sesion_date = $user->finish_sesion_date;
        $session_array = Util::validateDiffDate($finish_sesion_date, Util::getCurrentDate());

        if($session_array['fin_sesion']){

            Auth::logout();
            return Util::setResponseJson(200,"Se ha terminado la sesión");

        }else if($session_array['time'] > 0 && $session_array['time'] <= 2){

            return Util::setResponseJson(201,"En ".$session_array['time']. " minutos se terminará la sesión, ¿desea ampliar su sesión por otros 15 minutos?");
        }else{
            return Util::setResponseJson(400,"Restan ".$session_array['time']. " minutos, para que se termine la sesión.");
        }
       
    }

    public function assignSessionTime(Request $request){
        $fields = $request->validate([
            'id_user' => 'required',
        ]);

        $id_user = $fields['id_user'];
        $user = User::find($id_user);
        $session_time = 0;
        if($user->id_rol == 2){

            $user->start_sesion_date = Util::getCurrentDate();
            $user->finish_sesion_date = Util::getDateHourMinutes(30);
            $session_time=30;
            $user->save();

        }else{

            $user->start_sesion_date = Util::getCurrentDate();
            $user->finish_sesion_date = Util::getDateHourMinutes(15);
            $session_time=15;
            $user->save();
        }

        return Util::setResponseJson(200,"Se ha extendido el tiempo de sesión, por ".$session_time." minutos.");

    }

}
