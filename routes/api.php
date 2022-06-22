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
use App\Http\Controllers\Api\V1\QueryController;

//Route::apiResource('v1/admin', AdminController::class)->only(['store', 'index', 'update']);
Route::post('v1/admin/store', [AdminController::class, 'store']);
Route::get('v1/admin/index', [AdminController::class, 'index']);
Route::put('v1/admin/update', [AdminController::class, 'update']);

//Route::apiResource('v1/customer', CustomerController::class)->only(['store','show','index','edit']);

Route::post('v1/customer/store', [CustomerController::class, 'store']);
Route::get('v1/customer/show/{id}', [CustomerController::class, 'show']);
Route::get('v1/customer/index', [CustomerController::class, 'index']);
Route::post('v1/customer/update/{param}', [CustomerController::class, 'update']);
Route::get('v1/get_customers_param/{param}', [CustomerController::class, 'getCustomers']);
Route::post('v1/get_customers_by_customer_type', [CustomerController::class, 'getCustomersbyCustomerType']);
Route::post('v1/get_customers_by_customer_premium', [CustomerController::class, 'getCustomersbyCustomerPremium']);
Route::post('v1/customer/charge_customer_contract', [CustomerController::class, 'chargeCustomerContract']);
Route::post('v1/customer/charge_sarlaft_document', [CustomerController::class, 'chargeSARLAFTDocument']);
Route::post('v1/customer/changeprofilepicture', [CustomerController::class, 'changeProfilePicture']);

//Route::apiResource('v1/investment', InvestmentController::class)->only(['store','index', 'show']);

Route::post('v1/investment/store', [InvestmentController::class, 'store']);
Route::get('v1/investment/show/{id}', [InvestmentController::class, 'show']);
Route::get('v1/investment/index', [InvestmentController::class, 'index']);
Route::post('v1/investment/update/{param}', [InvestmentController::class, 'update']);
Route::get('v1/get_investments_by_customer/{param}', [InvestmentController::class, 'showByCustomer']);
Route::get('v1/investments_by_param/{param}', [InvestmentController::class, 'showByParams']);
Route::post('v1/reinvestment/store', [InvestmentController::class, 'storeReinvest']);

//Route::apiResource('v1/extracts', ExtractController::class)->only(['show']);

Route::get('v1/extracts/show/{customer}', [ExtractController::class, 'show']);
Route::post('v1/extracts_customer_premium', [ExtractController::class, 'extractCustomerPremium']);
Route::post('v1/extracts_by_customer_type', [ExtractController::class, 'extractByCustomerType']);
Route::get('v1/extracts_by_customer/{customer}', [ExtractController::class, 'getByCustomer']);
Route::post('v1/customer/extracts_by_customer_date', [ExtractController::class, 'getByCustomerAndDate']);


//Route::apiResource('v1/disbursetment', DisbursetmentController::class)->only(['show','store']);

Route::post('v1/disbursetment/store', [DisbursetmentController::class, 'store']);
Route::get('v1/disbursetment/show/{param}', [DisbursetmentController::class, 'show']);
Route::get('v1/disbursetment/showfiles', [DisbursetmentController::class, 'showFiles']);
Route::post('v1/disbursetment/update/{param}', [DisbursetmentController::class, 'update']);
Route::post('v1/disbursetment/update_by_customer_type', [DisbursetmentController::class, 'updateByCustomerType']);
Route::post('v1/disbursetment/generate_report', [DisbursetmentController::class, 'generateReport']);
Route::get('v1/get_disbursetments_by_params/{param}', [DisbursetmentController::class, 'showByParam']);


//Route::apiResource('v1/request', CustomerRequestController::class)->only(['store', 'show','index','update']);

Route::post('v1/request/store', [CustomerRequestController::class, 'store']);
Route::get('v1/request/show/{id}', [CustomerRequestController::class, 'show']);
Route::get('v1/request/index', [CustomerRequestController::class, 'index']);
Route::put('v1/request/update/{param}', [CustomerRequestController::class, 'update']);

Route::get('v1/get_request_by_date/{param}', [CustomerRequestController::class, 'getRequestByDate']);
Route::get('v1/get_last_active_request', [CustomerRequestController::class, 'getLastRequestActive']);


//Route::apiResource('v1/kpi', KpiController::class)->only(['show']);
Route::get('v1/kpi/show/{param}', [KpiController::class, 'show']);

Route::get('v1/get_state_by_country/{country_id}', [QueryController::class, 'showStatesByCountry']);
Route::get('v1/get_municipality_by_state/{state_id}', [QueryController::class, 'showMunicipalityByState']);


Route::post('login', [LoginController::class, 'login']);
Route::post('reset_password', [LoginController::class, 'resetPassword']);
Route::post('change_password', [LoginController::class, 'changePassword']);
Route::post('validate_sesion', [LoginController::class, 'validateSesionTime']);
Route::post('extend_session', [LoginController::class, 'assignSessionTime']);

//CUSTOMER

