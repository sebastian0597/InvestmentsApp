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

        $user = Auth::user();

        //dd($user);

        //if(session()->has('user')) {
            return $next($request);
        //}
    
        //throw new AuthenticationException('Not authenticated.');

    }
}
