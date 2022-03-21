<?php

namespace App\Utils;
use Carbon\Carbon;
use App\Mail\CredentialsMailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class Util 
{
    public static function generatePassword()
    {   
        $length=8;
        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $max = strlen($pattern)-1;
        for($i = 0; $i < $length; $i++){
            $key .= substr($pattern, mt_rand(0,$max), 1);
        }
        return $key;
    }

    public static function generatePersonalCode($email){
        $codigo_base = mb_strtoupper(strstr($email, '@', true));
        $codigo_base = strlen($codigo_base)>4 ? substr($codigo_base, 0, 4) : $codigo_base;
        $codigo = $codigo_base.rand(1000, 9999);
        return $codigo;
    }

    public static function  setResponseJson($status,$message,$token=""){
        
        return response()->json([
            'status'=> $status,
            'message' => $message,
            'token' => $token
        ]);

    }

    public static function banningUser($user){

        $user->ind_banned = 1;
        $user->banned_date = date('Y-m-d h:i:s');
        $user->save();
        return Util::setResponseJson(401,'Usuario bloqueado por el sistema, debido a que se detectó multiples intentos fallidos de inicio de sesion, para desbloquearlo, por favor comunicarse con un administrador.');
       
    }

    public static function validateCustomerLevel($amount){
       
        $customer_level='';
        $amount = intval($amount);
        
        if($amount > 1000000 && $amount < 25000000){

            $customer_level = 1;  
            
        }else if($amount >= 25000000 && $amount < 100000000){

            $customer_level = 2; 
        }
        else if($amount >= 100000000){

            $customer_level = 3; 
        }

        return $customer_level;
    }





    public static function validateLogin($request){
        
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'personal_code' => 'required|string'
        ]);

       return $fields;
    }

    public static function validateBlockedTime($date, $user){

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

    
    public static function sendEmailWithPDFFile($template,$params){
    
        $pdf = PDF::loadView($template, compact('params'));
    
        Mail::send('Emails.empty', [], function ($message) use ($params, $pdf) {
            $message->to($params["email"], $params["email"])
                ->subject($params["title"])
                ->attachData($pdf->output(), $params['document_name'].".pdf");
        });     
    }

    public static function sendCredentialsEmail($params){

        $mail = new CredentialsMailable($params);
        Mail::to($params["email"])->send($mail);

    }
}