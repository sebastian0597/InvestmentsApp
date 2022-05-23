<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\CustomerController;
use App\Http\Controllers\FrontEnd\ExtractController;
use App\Http\Controllers\FrontEnd\RequestController;
use App\Http\Controllers\FrontEnd\AdminController;
use App\Http\Controllers\FrontEnd\InvestmentController;
use App\Http\Controllers\FrontEnd\DisbursementController;


use App\Http\Controllers\FrontEnd\Customer\ProfileController;
use App\Http\Controllers\FrontEnd\Customer\InvestmentController AS InvestmentCustomerController;
use App\Http\Controllers\FrontEnd\Customer\DisbursetmentController AS DisbursetmentCustomerController;
use App\Http\Controllers\FrontEnd\Customer\ExtractController AS ExtractCustomerController;


use App\Http\Controllers\Api\LoginController;



Route::withoutMiddleware(['admin'])->group(function(){
    
    Route::get('login', function () { return view('login'); })->name('login');
    Route::post('login_validate', [LoginController::class, 'login']);
    Route::get('reestablecer_contrasena', function () { return view('reestablecer_contrasena'); })->name('reestablecer_contrasena');

});

Route::middleware(['admin'])->group(function(){

    Route::get('crear_cliente', [CustomerController::class, 'create'] )->name('crear_cliente');
    Route::get('editar_cliente/{id_cliente}', [CustomerController::class, 'edit'] )->name('editar_cliente');
    Route::get('clientes', [CustomerController::class, 'index'] )->name('clientes');
    Route::get('/', [CustomerController::class, 'index'] )->name('inicio');
    Route::get('extractos', [ExtractController::class, 'index'] )->name('extractos');
    Route::get('solicitudes',  [RequestController::class, 'index'] )->name('solicitudes');
    Route::get('crear_administrador',  [AdminController::class, 'index'] )->name('crear_administrador');
    Route::get('editar_administrador/{id_usuario}',  [AdminController::class, 'show'] )->name('editar_administrador');
    Route::get('inversiones',  [InvestmentController::class, 'index'] )->name('inversiones');
    Route::get('crear_inversion/{id_cliente}',  [InvestmentController::class, 'create'] )->name('crear_inversion');
    Route::get('editar_inversion/{id_inversion}',  [InvestmentController::class, 'edit'] )->name('editar_inversion');

    Route::get('kpis', function () { return view('Admins.kpis'); })->name('kpis');
    Route::get('desembolsos', [DisbursementController::class, 'index'])->name('desembolsos');
    Route::get('editar_desembolso/{id_desembolso}',  [DisbursementController::class, 'edit'] )->name('editar_desembolso');
    
    Route::get('cambiar_contrasena', function () { return view('Admins.cambiar_contrasena'); })->name('cambiar_contrasena');

    Route::get('extractos_pdfs/{id_customer}', [ExtractController::class, 'pdfExtract'] )->name('extractos_pdfs');
    Route::get('logout', [LoginController::class, 'logout']);

});


Route::withoutMiddleware(['admin'])->group(function(){
    
    Route::get('cliente/perfil', [ProfileController::class, 'index'])->name('clientes.perfil');
    Route::get('cliente/inversiones', [InvestmentCustomerController::class, 'index'])->name('clientes.inversiones');
    Route::get('cliente/desembolsos', [DisbursetmentCustomerController::class, 'index'])->name('clientes.desembolsos');
    Route::get('cliente/extractos', [ExtractCustomerController::class, 'index'])->name('clientes.extractos');
    
    
    Route::get('cliente/documentos', function () { return view('clientes.documentos'); });
    Route::get('cliente/solicitudes', function () { return view('clientes.solicitudes'); });

});

