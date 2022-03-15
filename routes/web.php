<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {

    $data["email"] =  "oibanez@unab.edu.co";
    $data["title"] = "Bienvenido a la plataforma Investment";
    $data["code"] = "OIBANEZ28469"; 
    $data["password"] = "123455";
    
    return view('Emails.credentials', compact('data'));
});
*/
Route::get('/', function () {
    return view('app');
});

Route::get('/pdf', function () {
    return view('Emails.bank_promissor_note');
});


Route::get('login', function () {
    return view('login');
});