<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\V1\CustomerRequestController;
use App\Http\Controllers\Api\InvestmentController;

Route::apiResource('v1/admin', AdminController::class)->only(['store']);
Route::apiResource('v1/customer', CustomerController::class)->only(['store','show']);
Route::apiResource('v1/request', CustomerRequestController::class)->only(['store', 'show','index','update']);

Route::get('v1/get_customers_param/{param}', [CustomerController::class, 'getCustomers']);
Route::post('login', [LoginController::class, 'login']);
Route::post('reset_password', [LoginController::class, 'resetPassword']);

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
