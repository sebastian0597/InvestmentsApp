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


Route::apiResource('v1/admin', AdminController::class)->only(['store']);


Route::apiResource('v1/customer', CustomerController::class)->only(['store','show','index']);
Route::get('v1/get_customers_param/{param}', [CustomerController::class, 'getCustomers']);
Route::post('v1/get_customers_by_customer_type', [CustomerController::class, 'getCustomersbyCustomerType']);


Route::apiResource('v1/investment', InvestmentController::class)->only(['store','index']);
Route::get('v1/get_investments_by_customer/{param}', [InvestmentController::class, 'showByCustomer']);
Route::post('v1/set_percentaje_by_customer_type', [InvestmentController::class, 'setPercentajeByCustomerType']);
Route::post('v1/extracts_customer_premium', [ExtractController::class, 'extractCustomerPremium']);


Route::apiResource('v1/disbursetment', DisbursetmentController::class)->only(['store']);


Route::apiResource('v1/request', CustomerRequestController::class)->only(['store', 'show','index','update']);


Route::post('login', [LoginController::class, 'login']);
Route::post('reset_password', [LoginController::class, 'resetPassword']);