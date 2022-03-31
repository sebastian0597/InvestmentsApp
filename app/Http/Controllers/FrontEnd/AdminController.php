<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rol;

class AdminController extends Controller
{
    public function index(){
        $roles = Rol::where('status',1)->where('ind_admin_rol',1)->get();
        return view('Admins.perfil_administrador', compact('roles'));
    }
}
