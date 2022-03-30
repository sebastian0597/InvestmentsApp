<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\CustomerController;
use App\Http\Controllers\FrontEnd\ExtractController;

Route::get('login', function () {
    return view('login');
})->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('crear_cliente', [CustomerController::class, 'create'])->name('crear_cliente');
    //Route::get('clientes', [CustomerController::class, 'index'])->name('clientes');
    Route::get('/', [CustomerController::class, 'index'])->name('inicio');
    Route::get('extractos', [ExtractController::class, 'index'] )->name('extractos');

    //Route::get('/', function () { return view('Admins.clientes'); })->name('');
    //Route::get('clientes', function () { return view('Admins.clientes'); })->name('clientes');
    //Route::get('crear_cliente', function () { return view('Admins.crear_cliente'); });
  
});

//Route::get('clientes', [CustomerController::class, 'index'])->name('clientes');

/*Route::middleware(['admin'])->group(function (){
    Route::get('crear_cliente', [CustomerController::class, 'create'])->name('crear_cliente');
    //Route::get('clientes', [CustomerController::class, 'index'])->name('clientes');
    Route::get('/', [CustomerController::class, 'index'])->name('inicio');
    Route::get('extractos', [ExtractController::class, 'index'] )->name('extractos');
});*/
/*Route::get('/currency', function (){
    $currencies = Currency::all();
    return view('Administradores/index', compact('currencies')); 
 
});*/


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
