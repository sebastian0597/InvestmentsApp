<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class AdminMiddleware
{
 
    public function handle(Request $request, Closure $next)
    {   
      
        if (auth()->check()) {
            
          
            if(Auth::User()->id_rol <> 2){
                return $next($request);
            }
            
        }

        return redirect()->route('login');

    }

    /*public function handle($request, Closure $next, ...$roles)
    {   

        return $roles;
        $roleIds = ['admin' => 1, 'user' => 2, 'editor' => 3];
        $allowedRoleIds = [];
        foreach ($roles as $role)
        {
            if(isset($roleIds[$role]))
            {
                $allowedRoleIds[] = $roleIds[$role];
            }
        }
        $allowedRoleIds = array_unique($allowedRoleIds); 
      
        if(Auth::check()) {
            //if(in_array(Auth::user()->id_rol, $allowedRoleIds)) {
                return $next($request);
            //}
        }

        return redirect('login');

    }*/


}
