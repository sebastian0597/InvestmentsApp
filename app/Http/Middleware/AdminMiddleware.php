<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Session;

class AdminMiddleware
{
 
    public function handle(Request $request, Closure $next)
    {   


        if(!Auth::user())
        {
            return redirect()->route('login');
        }
    
        // Pass the request down the rest of pipeline
        return $next($request); 
        
        //return $next($request);
        /*if($user) {
            return $next($request);
        }
    
        throw new AuthenticationException('Not authenticated.');*/

    }
}
