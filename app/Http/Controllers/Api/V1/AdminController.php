<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
  
    public function index()
    {
        //
    }

    public function create()
    {
       
    }


    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'id_rol' => 'required|numeric'
        ]);

        $password = "12345";
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($password),
            'id_rol' => $fields['id_rol'],
            'personal_code' =>  mb_strtoupper(strstr($fields['email'], '@', true)).rand(1000, 9999),

        ]);

        
        /*$admin = Admin::create([
            'id_user' => $user->id,
            
        ]);*/
  
        $token = $user->createToken('myapptoken')->plainTextToken;

        $data["email"] =  $fields['email'];
        $data["title"] = "Bienvenido a la plataforma Investment";
        $data["code"] =  mb_strtoupper(strstr($fields['email'], '@', true)).rand(1000, 9999);
        $data["password"] = $password;
        

        Mail::send([], $data, function ($message) use ($data) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"]);
                //->attachData($pdf->output(), "Certificado_inscripcion_curso_ofalmologia_FOSCAL.pdf");
        });

        return response()->json([
            'status'=> 201,
            'user' => $user,
            'token' => $token,
        ]);
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
    public function update(Request $request, Admin $admin)
    {
        //
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
