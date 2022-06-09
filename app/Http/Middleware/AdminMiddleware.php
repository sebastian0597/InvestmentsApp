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
      
        if (auth()->check() /*&& auth()->user()->id_rol === 1*/) {//Si no es cliente

            return $next($request);

        }
        return back();
        //return redirect('cliente/perfil');//Si es cliente
        //return $next($request);
     
    }

}
