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


Route::apiResource('v1/investment', InvestmentController::class)->only(['store','index', 'show']);
Route::post('v1/reinvestment', [InvestmentController::class, 'storeReinvest']);
Route::post('v1/investment/update/{param}', [InvestmentController::class, 'update']);
Route::get('v1/get_investments_by_customer/{param}', [InvestmentController::class, 'showByCustomer']);
Route::get('v1/investments_by_param/{param}', [InvestmentController::class, 'showByParams']);

Route::apiResource('v1/extracts', ExtractController::class)->only(['show']);
Route::post('v1/extracts_customer_premium', [ExtractController::class, 'extractCustomerPremium']);
Route::post('v1/extracts_by_customer_type', [ExtractController::class, 'extractByCustomerType']);

Route::apiResource('v1/disbursetment', DisbursetmentController::class)->only(['show','store']);
Route::get('v1/get_disbursetments_by_params/{param}', [DisbursetmentController::class, 'showByParam']);
Route::post('v1/disbursetment/update/{param}', [DisbursetmentController::class, 'update']);
Route::post('v1/disbursetment/generate_report', [DisbursetmentController::class, 'generateReport']);




Route::apiResource('v1/request', CustomerRequestController::class)->only(['store', 'show','index','update']);
Route::get('v1/get_request_by_date/{param}', [CustomerRequestController::class, 'getRequestByDate']);
Route::get('v1/get_last_active_request', [CustomerRequestController::class, 'getLastRequestActive']);


Route::apiResource('v1/kpi', KpiController::class)->only(['show']);


Route::post('login', [LoginController::class, 'login']);
Route::post('reset_password', [LoginController::class, 'resetPassword']);