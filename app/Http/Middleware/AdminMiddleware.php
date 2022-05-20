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

       
    
        //return $next($request); 
     
    }
}
