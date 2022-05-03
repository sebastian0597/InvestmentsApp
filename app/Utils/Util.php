<?php

namespace App\Utils;
use Carbon\Carbon;
use App\Mail\CredentialsMailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

use App\Models\Extract;
use App\Models\ExtractDetail;

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
        
        if($amount >= 1000000 && $amount < 25000000){

            $customer_level = 1;  
            
        }else if($amount >= 25000000 && $amount < 100000000){

            $customer_level = 2; 
        }
        else if($amount >= 100000000){

            $customer_level = 3; 
            
        }else{

            $customer_level = 1;   
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

    public static function calculateProfitableDays($date, $days){ 
        $result=-1;

        $investmentDays = intval(substr($date,8,2));

        if(!is_null($investmentDays)){
            $result = $days-$investmentDays;
        }

        return $result+1;//Se le suma 1 dia para que tome tambien el ultimo dia de la inversion

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

    public static function totalInvestedByCustomer($id_customer, $invested_type){

        $mail = new CredentialsMailable($params);
        Mail::to($params["email"])->send($mail);

    }

    public static function downloadPDF(){

        $data = [
            'titulo' => 'Prueba'
        ];
    
        $pdf = PDF::loadView('Pdfs.disbursement', $data);
    
        return $pdf->download('desembolso.pdf');
    }

    public static function validateDaysNumberByMonth($month){
        //Se validan que todos los meses tengam 30 dias de rentabilidad, excepto marzo.
        $days = 30;
        if($month == "02"){
            $days=28;
        }

        return $days;
    }

    public static function getCurrentDate(){
        $fecha_actual = new Carbon();
        $fecha_actual=$fecha_actual->setTimezone('America/Bogota');
        $time = strtotime($fecha_actual);
        $fecha_local = date("Y-m-d H:i:s", $time);

        return $fecha_local;
    }

    public static function setJSONResponse($object){
        $object = json_encode($object);       
        $object = json_decode($object, true);
        $json = $object["data"];
        return $json;
    }

    public static function setJSONResponseUniqueData($object){
        $object = json_encode($object);
        $json = json_decode($object, true);
        return $json;
       
    }

    public static function deleteExtracts($id_customer, $month){

        $older_extracts = Extract::getExtractByCustomerAndMonth($id_customer, $month);
        foreach($older_extracts as $item){
            
            $id_extract = $item->id;
            
            ExtractDetail::where('id_extract', $id_extract )->delete();
            Extract::where('id', $id_extract)->delete();
        }   

    }

    /*public function compressImage($source, $destination, $quality) { 
        // Obtenemos la información de la imagen
        $imgInfo = getimagesize($source); 
        $mime = $imgInfo['mime']; 
        
        // Creamos una imagen
        switch($mime){ 
            case 'image/jpeg': 
                $image = imagecreatefromjpeg($source); 
                break; 
            case 'image/png': 
                $image = imagecreatefrompng($source); 
                break; 
            case 'image/gif': 
                $image = imagecreatefromgif($source); 
                break; 
            default: 
                $image = $source; 
                break;
        } 
        
        // Guardamos la imagen
        imagejpeg($image, $destination, $quality); 
        
        // Devolvemos la imagen comprimida
        return $destination; 
    } */

    public static function inactivateInvestments($investments){

        if(count($investments)>0){

            foreach($investments as $investment){

                $investment->status = 2;

                if(!is_null($investment->consignment_file)){

                    $consignment_file = $investment->consignment_file;
                }

                $investment->update();  
            }
           
        }else{

            return array(404, 'No se han encontrado inversiones activas para este cliente.' );
        }
    }

    public static function inactivateExtracts($extracts){

        if(count($extracts)>0){

            foreach($extracts as $extract){

                $extract->status = 2;
                $extract->update();
                
            }
           
        }else{

            return array(404, 'No se han encontrado extractos activos para este cliente.'  );
        }
    }
}