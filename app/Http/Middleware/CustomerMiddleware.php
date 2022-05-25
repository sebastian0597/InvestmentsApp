<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {   
      
        if (auth()->check()/* && auth()->user()->id_rol == 2*/) {
            
            return $next($request);

        }

            //return redirect('clientes');
            //return back();
       
    }
}
