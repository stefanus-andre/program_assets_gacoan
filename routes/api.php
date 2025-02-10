<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APILoginController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/coba', function(){
    return "ini coba";
});

Route::post('/login', [APILoginController::class, 'Login']);
Route::post('/logout', [APILoginController::class, 'Logout']);