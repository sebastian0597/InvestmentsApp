<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

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

       
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt('12345678'),
            'id_rol' => $fields['id_rol'],

        ]);

        
        $admin = Admin::create([
            'id_user' => $user->id,
            'admin_code' =>  mb_strtoupper(strstr($fields['email'], '@', true)).rand(1000, 9999),
        ]);
  
        $token = $user->createToken('myapptoken')->plainTextToken;

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
