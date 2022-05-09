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

        if(session()->has('user')) {
            return $next($request);
        }
    
        throw new AuthenticationException(session()->has('user'));

    }

    public function boot(){
        view()->composer('*', function ($view) 
        {
            //this code will be executed when the view is composed, so session will be available
            $view->with('key', \Session::get('user') );    
        });  
}
}
