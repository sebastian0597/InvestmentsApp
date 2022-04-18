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

Route::get('reestablecer_contrasena', function () {
    return view('reestablecer_contrasena');
})->name('reestablecer_contrasena');

Route::get('logout', function () {
    return view('login');
})->name('logout');

Route::get('contrato', function () {
    

    $customer_fullname = "Omar Yesid Ibanez Ortiz";
    $params["email"] = "Oibanez@unab.edu.co";
    $params["title"] = "Pagaré del cliente 1098796215 ".$customer_fullname;
    $params["amount"] = 50000;
    $params["investment_date"] = date('d/m/Y');
    $params["bank_promissor_number"] = 5258;
    $params["document_number"] = 1098796215;
    $params["customer_name"] = $customer_fullname;
    $params["document_name"] = "Pagare_1098796215_".$customer_fullname;

    return view('Pdfs.bank_promissor_note', compact('params'));
    
})->name('contrato');


//Route::group(['middleware' => ['auth']], function () {
    Route::get('crear_cliente', [CustomerController::class, 'create'] )->name('crear_cliente');
    Route::get('editar_cliente/{id_cliente}', [CustomerController::class, 'edit'] )->name('editar_cliente');
    Route::get('clientes', [CustomerController::class, 'index'] )->name('clientes');
    Route::get('/', [CustomerController::class, 'index'] )->name('inicio');
    Route::get('extractos', [ExtractController::class, 'index'] )->name('extractos');
    Route::get('solicitudes',  [RequestController::class, 'index'] )->name('solicitudes');
    Route::get('crear_administrador',  [AdminController::class, 'index'] )->name('crear_administrador');
    Route::get('inversiones',  [InvestmentController::class, 'index'] )->name('inversiones');
    Route::get('crear_inversion/{id_cliente}',  [InvestmentController::class, 'create'] )->name('crear_inversion');
    Route::get('editar_inversion/{id_inversion}',  [InvestmentController::class, 'edit'] )->name('editar_inversion');
    
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

