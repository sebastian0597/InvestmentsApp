<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Utils\Util;
use App\Mail\CredentialsMailable;

class AdminController extends Controller
{
  
    public function index()
    {
      
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

        $password = Util::generatePassword();
        $personal_code = Util::generatePersonalCode($fields['email']);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($password),
            'id_rol' => $fields['id_rol'],
            'personal_code' => $personal_code,

        ]);
  
        $token = $user->createToken('myapptoken')->plainTextToken;

        $data["email"] =  $fields['email'];
        $data["title"] = "Te damos la bienvenida a VIP World Trading";
        $data["code"] = $personal_code; 
        $data["password"] = $password;
        
        $mail = new CredentialsMailable($data);
        Mail::to($data["email"])->send($mail);

        return  Util::setResponseJson(201, $user, $token);
      
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
