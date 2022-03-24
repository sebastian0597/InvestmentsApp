<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\CustomerController;

Route::get('/', function () {
    return view('login');
});

Route::get('crear_cliente', [CustomerController::class, 'create']);

Route::get('clientes', function () { return view('Admins.clientes'); });
//Route::get('crear_cliente', function () { return view('Admins.crear_cliente'); });
Route::get('extractos', function () { return view('Admins.extractos'); });

/*Route::get('/currency', function (){
    $currencies = Currency::all();
    return view('Administradores/index', compact('currencies')); 

});*/

