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
use App\Http\Controllers\FrontEnd\Customer\RequestCustomerController;

use App\Http\Controllers\Api\LoginController;



Route::withoutMiddleware(['admin', 'customer'])->group(function(){
    
    Route::get('login', function () { return view('login'); })->name('login');
    Route::post('login_validate', [LoginController::class, 'login']);
    Route::get('reestablecer_contrasena', function () { return view('reestablecer_contrasena'); })->name('reestablecer_contrasena');

});

/*Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::group(['middleware' => ['auth', 'role']], function () {
        // All routes you put here can only be accessible to users with super-admin role

    });

    Route::group(['middleware' => 'auth'], function () {
        // All routes you put here can be accessible to all authenticated users

    });
});*/

//Route::middleware('admin:1')->group(function(){

    Route::get('crear_cliente', [CustomerController::class, 'create'] )->name('crear_cliente')->middleware('admin');
    Route::get('editar_cliente/{id_cliente}', [CustomerController::class, 'edit'] )->name('editar_cliente')->middleware('admin');
    Route::get('clientes', [CustomerController::class, 'index'] )->name('clientes')->middleware('admin');
    Route::get('/', [CustomerController::class, 'index'] )->name('inicio')->middleware('admin');
    Route::get('extractos', [ExtractController::class, 'index'] )->name('extractos')->middleware('admin');
    Route::get('solicitudes',  [RequestController::class, 'index'] )->name('solicitudes')->middleware('admin');
    Route::get('crear_administrador',  [AdminController::class, 'index'] )->name('crear_administrador')->middleware('admin');
    Route::get('editar_administrador/{id_usuario}',  [AdminController::class, 'show'] )->name('editar_administrador')->middleware('admin');
    Route::get('inversiones',  [InvestmentController::class, 'index'] )->name('inversiones')->middleware('admin');
    Route::get('crear_inversion/{id_cliente}',  [InvestmentController::class, 'create'] )->name('crear_inversion')->middleware('admin');
    Route::get('editar_inversion/{id_inversion}',  [InvestmentController::class, 'edit'] )->name('editar_inversion')->middleware('admin');

    Route::get('kpis', function () { return view('Admins.kpis'); })->name('kpis')->middleware('admin');
    Route::get('desembolsos', [DisbursementController::class, 'index'])->name('desembolsos')->middleware('admin');
    Route::get('editar_desembolso/{id_desembolso}',  [DisbursementController::class, 'edit'] )->name('editar_desembolso')->middleware('admin');
    
    Route::get('cambiar_contrasena', function () { return view('Admins.cambiar_contrasena'); })->name('cambiar_contrasena')->middleware('admin');

    Route::get('extractos_pdfs/{id_customer}', [ExtractController::class, 'pdfExtract'] )->name('extractos_pdfs')->middleware('admin');
    Route::get('logout', [LoginController::class, 'logout'])->middleware('admin');

//});


//Route::withoutMiddleware('admin:1')->group(function(){
    
    Route::get('cliente/perfil', [ProfileController::class, 'index'])->name('clientes.perfil')->middleware('customer');
    Route::get('cliente/inversiones', [InvestmentCustomerController::class, 'index'])->name('clientes.inversiones')->middleware('customer');
    Route::get('cliente/desembolsos', [DisbursetmentCustomerController::class, 'index'])->name('clientes.desembolsos')->middleware('customer');
    Route::get('cliente/extractos', [ExtractCustomerController::class, 'index'])->name('clientes.extractos')->middleware('customer');
    Route::get('cliente/solicitudes', [RequestCustomerController::class, 'index'])->name('clientes.solicitudes')->middleware('customer');
    
    
    Route::get('cliente/documentos', function () { return view('clientes.documentos'); })->middleware('customer');
    //Route::get('cliente/solicitudes', function () { return view('clientes.solicitudes'); });

//});

