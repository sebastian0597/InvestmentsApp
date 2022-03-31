<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\CustomerController;
use App\Http\Controllers\FrontEnd\ExtractController;
use App\Http\Controllers\FrontEnd\RequestController;
use App\Http\Controllers\FrontEnd\AdminController;
use App\Http\Controllers\FrontEnd\InvestmentController;


Route::get('login', function () {
    return view('login');
})->name('login');


//Route::group(['middleware' => ['admin']], function () {
    Route::get('crear_cliente', [CustomerController::class, 'create'] )->name('crear_cliente');
    Route::get('clientes', [CustomerController::class, 'index'] )->name('clientes');
    Route::get('/', [CustomerController::class, 'index'] )->name('inicio');
    Route::get('extractos', [ExtractController::class, 'index'] )->name('extractos');
    Route::get('solicitudes',  [RequestController::class, 'index'] )->name('solicitudes');
    Route::get('crear_administrador',  [AdminController::class, 'index'] )->name('crear_administrador');
    Route::get('investments',  [InvestmentController::class, 'index'] )->name('investments');
    
    //Route::get('clientes', function () { return view('Admins.clientes'); })->name('clientes');
    //Route::get('crear_cliente', function () { return view('Admins.crear_cliente'); });
  
//});

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

