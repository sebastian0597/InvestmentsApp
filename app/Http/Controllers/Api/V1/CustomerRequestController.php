<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerRequest;

use Illuminate\Support\Facades\DB;
use App\Utils\Util;
use App\Http\Resources\V1\RequestResource;
use App\Http\Resources\V1\RequestCollection;

class CustomerRequestController extends Controller
{
   
    public function index()
    {
        return new RequestCollection(CustomerRequest::latest()->paginate());
    }


    public function store(Request $request)
    {

        $request_answer = DB::transaction(function () use($request){
            
            $fields = $request->validate([
                'id_customer' => 'required|string',
                'request_type' => 'required|numeric',
                'description' => 'required|string'

            ]);

            $fecha_local = Util::getCurrentDate();
            

            $requestModel = CustomerRequest::create([

                'id_customer' =>   $fields['id_customer'],
                'request_date' =>  $fecha_local,
                'request_type' =>  $fields['request_type'],
                'description' =>   $fields['description'],
    
            ]);

        }, 3); 

        return Util::setResponseJson(201,  "Solicitud creada exitosamente.");

    }


    public function show($id)
    {
        return new RequestResource(CustomerRequest::find($id));
    }

 
    public function update(Request $request, $id)
    {
        $request_customer = CustomerRequest::find($id);
        
        $request_update = DB::transaction(function () use($request_customer,$request){
            
            if($request_customer){

                $fields = $request->validate([
                    'id_user_attends_request' => 'required|numeric',
                    'answer' => 'required|string',
                ]);
                
                $fecha_local = Util::getCurrentDate();
                
                $request_customer->id_user_attends_request = $fields["id_user_attends_request"];
                $request_customer->answer = $fields["answer"];
                $request_customer->answer_date = $fecha_local;
                $request_customer->status = 2;
                $request_customer->update();

                return array(201,$request_customer);
            
            }else{
                return array(404,"La solicitud no se ha encontrado.");
            }

        }, 3); 

        return Util::setResponseJson($request_update[0], $request_update[1]);
    }

  
    public function destroy(Request $request)
    {
        //
    }
}
