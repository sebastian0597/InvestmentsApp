<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\V1\CustomerRequestController;
use App\Http\Controllers\Api\V1\InvestmentController;
use App\Http\Controllers\Api\V1\DisbursetmentController;
use App\Http\Controllers\Api\V1\ExtractController;
use App\Http\Controllers\Api\V1\KpiController;

Route::apiResource('v1/admin', AdminController::class)->only(['store', 'index', 'update']);

Route::apiResource('v1/customer', CustomerController::class)->only(['store','show','index','edit']);
Route::post('v1/customer/update/{param}', [CustomerController::class, 'update']);
Route::get('v1/get_customers_param/{param}', [CustomerController::class, 'getCustomers']);
Route::post('v1/get_customers_by_customer_type', [CustomerController::class, 'getCustomersbyCustomerType']);
Route::post('v1/get_customers_by_customer_premium', [CustomerController::class, 'getCustomersbyCustomerPremium']);
Route::post('v1/customer/charge_customer_contract', [CustomerController::class, 'chargeCustomerContract']);
Route::post('v1/customer/charge_sarlaft_document', [CustomerController::class, 'chargeSARLAFTDocument']);

Route::apiResource('v1/investment', InvestmentController::class)->only(['store','index', 'show']);
Route::post('v1/reinvestment', [InvestmentController::class, 'storeReinvest']);
Route::post('v1/investment/update/{param}', [InvestmentController::class, 'update']);
Route::get('v1/get_investments_by_customer/{param}', [InvestmentController::class, 'showByCustomer']);
Route::get('v1/investments_by_param/{param}', [InvestmentController::class, 'showByParams']);

Route::apiResource('v1/extracts', ExtractController::class)->only(['show']);
Route::post('v1/extracts_customer_premium', [ExtractController::class, 'extractCustomerPremium']);
Route::post('v1/extracts_by_customer_type', [ExtractController::class, 'extractByCustomerType']);
Route::get('v1/extracts_by_customer/{customer}', [ExtractController::class, 'getByCustomer']);

Route::get('v1/disbursetment/showfiles', [DisbursetmentController::class, 'showFiles']);
Route::post('v1/disbursetment/update/{param}', [DisbursetmentController::class, 'update']);
Route::post('v1/disbursetment/update_by_customer_type', [DisbursetmentController::class, 'updateByCustomerType']);
Route::post('v1/disbursetment/generate_report', [DisbursetmentController::class, 'generateReport']);
Route::get('v1/get_disbursetments_by_params/{param}', [DisbursetmentController::class, 'showByParam']);
Route::apiResource('v1/disbursetment', DisbursetmentController::class)->only(['show','store']);

Route::apiResource('v1/request', CustomerRequestController::class)->only(['store', 'show','index','update']);
Route::get('v1/get_request_by_date/{param}', [CustomerRequestController::class, 'getRequestByDate']);
Route::get('v1/get_last_active_request', [CustomerRequestController::class, 'getLastRequestActive']);


Route::apiResource('v1/kpi', KpiController::class)->only(['show']);

Route::post('login', [LoginController::class, 'login']);
Route::post('reset_password', [LoginController::class, 'resetPassword']);
Route::post('change_password', [LoginController::class, 'changePassword']);
Route::post('validate_sesion', [LoginController::class, 'validateSesionTime']);
Route::post('extend_session', [LoginController::class, 'assignSessionTime']);

//CUSTOMER
Route::get('v1/customer/extracts_by_customer/{date}', [ExtractController::class, 'getByCustomerAndDate']);
Route::post('v1/customer/changeprofilepicture', [CustomerController::class, 'changeProfilePicture']);


Route::get('contrato_pdf', function () { 
    
    
    $customer_fullname = "OMAR YESID IBÁÑEZ ORTIZ";

    $params["email"] = "oibanez@unab.edu.co";
    $params["title"] = "Pagaré del cliente 1098796215"." ".$customer_fullname;
    $params["amount"] = '50000000';
    $params["investment_date"] = date('d/m/Y');
    $params["bank_promissor_number"] = "20";
    $params["document_number"] = "1098796215";
    $params["customer_name"] = $customer_fullname;
    $params["document_name"] = "Pagare_1098796215_".$customer_fullname;

    $pdf = PDF::loadView('Pdfs.bank_promissor_note', compact('params'))->setPaper('a4', 'landscape');
    //$pdf->stream('archivo.pdf');
    return $pdf->download('archivo.pdf');
    //Util::sendEmailWithPDFFile('Pdfs.bank_promissor_note', $params);
});

Route::get('extracto_pdf', function () { 
    
    
    $customer_fullname = "OMAR YESID IBÁÑEZ ORTIZ";

    $params["email"] = "oibanez@unab.edu.co";
    $params["title"] = "Pagaré del cliente 1098796215"." ".$customer_fullname;
    $params["amount"] = '5000000000';
    $params["investment_date"] = date('d/m/Y');
    $params["bank_promissor_number"] = "20";
    $params["document_number"] = "1098796215";
    $params["customer_name"] = $customer_fullname;
    $params["document_name"] = "Pagare_1098796215_".$customer_fullname;
   
    $pdf = PDF::loadView('Pdfs.extract')->setPaper('a4', 'landscape');
    return $pdf->download('archivo.pdf');
    //Util::sendEmailWithPDFFile('Pdfs.bank_promissor_note', $params);
});
