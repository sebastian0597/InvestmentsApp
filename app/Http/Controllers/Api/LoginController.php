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


        if (Auth::attempt(['email' => $fields['email'], 'password' => $fields['password'], 'status' => 1])) {
                
            $user->ind_banned=NULL;
            $user->ind_blocked=NULL;
            $user->time_blocked=NULL;
            $user->blocked_date=NULL;
            $user->banned_date=NULL;
            $user->failed_login_attempts=NULL;
            $user->save();

            
            //return Auth::user();
            $token = $user->createToken('myapptoken')->plainTextToken;
            //return redirect()->intended(route('clientes'));

            return Util::setResponseJson(200, auth()->user() , $token);
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
            $user->update();
            return Util::setResponseJson(200,"Se ha cambiado la contraseña correctamente.");

        }else{

            return Util::setResponseJson(401,"Las contraseñas ingresadas no coninciden.");

        }

    }
    

    public function logout(Request $request){

        auth()->user()->tokens()->delete();
        return response()->json([            
            'message' => "La sesión se ha finalizado.",
        ]);
    }

}
