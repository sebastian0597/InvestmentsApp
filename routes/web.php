<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\CustomerController;
use App\Http\Controllers\FrontEnd\ExtractController;
use App\Http\Controllers\FrontEnd\RequestController;
use App\Http\Controllers\FrontEnd\AdminController;
use App\Http\Controllers\FrontEnd\InvestmentController;
use App\Http\Controllers\FrontEnd\DisbursementController;
use App\Http\Controllers\Api\LoginController;


Route::get('login', function () { return view('login'); })->name('login')->withoutMiddleware('admin');

Route::post('login_validate', [LoginController::class, 'login'])->withoutMiddleware('admin');

Route::get('reestablecer_contrasena', function () { return view('reestablecer_contrasena'); })->name('reestablecer_contrasena')->withoutMiddleware('admin');


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

Route::middleware(['customer'])->group(function(){
    
    Route::get('cliente/desembolsos', function () { return view('clientes.desembolsos'); });
    Route::get('cliente/extractos', function () { return view('clientes.extractos'); });
    Route::get('cliente/perfil', function () { return view('clientes.perfil'); });
    Route::get('cliente/inversiones', function () { return view('clientes.inversiones'); });
    Route::get('cliente/documentos', function () { return view('clientes.documentos'); });
    Route::get('cliente/solicitudes', function () { return view('clientes.solicitudes'); });

});

