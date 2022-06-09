<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Models\ModelHasRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Utils\Util;
use App\Mail\CredentialsMailable;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\V1\AdminResource;
use App\Http\Resources\V1\AdminCollection;

class AdminController extends Controller
{
  
    public function index()
    {
        return new AdminCollection(Admin::all());
    }

    public function create()
    {
       
    }


    public function store(Request $request)
    {
        $admin = DB::transaction(function () use($request){

            $fields = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'id_rol' => 'required|numeric'
            ]);

            $password = Util::generatePassword();
            $personal_code = Util::generatePersonalCode($fields['email']);
           
            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => bcrypt($password),
                'personal_code' => $personal_code,

            ]);

            $rol = ModelHasRol::create([
                'role_id' => $fields['id_rol'],
                'model_type' => 'App\Models\User',
                'model_id' => $user->id,
               
            ]);

    
            $token = $user->createToken('myapptoken')->plainTextToken;

            $dataAdmin["email"] =  $fields['email'];
            $dataAdmin["name"] =  $fields['name'];
            $dataAdmin["title"] = "Te damos la bienvenida a VIP World Trading";
            $dataAdmin["code"] = $personal_code; 
            $dataAdmin["password"] = $password;
            
            Util::sendCredentialsEmail($dataAdmin);

            return array("Se ha creado el administrador correctamente.", $token);

        }, 3); 
        
        return  Util::setResponseJson(201, $admin[0], $admin[1]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $model_has_rol = ModelHasRol::where('model_id',$id)->first();

        $admin_response = DB::transaction(function () use($admin,$model_has_rol,$request){
            
            if($admin){
                
                $fields = $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email',
                    'status' => 'required|string',
                    'rol' => 'required|string',
                ]);
                //$fecha_local = Util::getCurrentDate();
                
                $admin->name = $fields["name"];
                $admin->email = $fields["email"];
                //$admin->id_rol = $fields["rol"];
                $admin->status = $fields["status"];
                $admin->update();
                
                $model_has_rol->role_id = $fields["rol"];
                $model_has_rol->update();

                return array(201,"Se ha actualizado el administrador correctamente.");
            
            }else{
                return array(402,"No se ha encontrado el administrador que desea actualizar.");
            }

        }, 3); 

        return Util::setResponseJson($admin_response [0], $admin_response [1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

  
}
