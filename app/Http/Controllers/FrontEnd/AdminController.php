<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



use App\Http\Resources\V1\AdminResource;

use App\Models\Rol;
use App\Models\Admin;

use App\Utils\Util;

class AdminController extends Controller
{
    public function __construct()
    {   
    
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){
        $roles = Rol::where('status',1)->where('ind_admin_rol',1)->get();
        return view('Admins.perfil_administrador', compact('roles'));
    }

    public function show($id_user){

        $admin = new AdminResource(Admin::find($id_user));
        $admin = Util::setJSONResponseUniqueData($admin);
      
        $roles = Rol::where('status',1)->where('ind_admin_rol',1)->get();
        return view('Admins.editar_admin', compact('admin','roles'));
    }
}
