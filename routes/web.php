<?php

use Illuminate\Support\Facades\Route;
use App\Models\Currency;

Route::get('/', function () {
    return view('login');
});


Route::get('/currency', function (){

    $currencies = Currency::all();
    return view('Administradores/index', compact('currencies')); 

});

