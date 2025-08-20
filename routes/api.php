<?php

use App\Http\Controllers\Api\authController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;






Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('products', ProductController::class);

Route::post('register', [authController::class,'register']);
Route::post('login', [authController::class,'login']);

Route::post('logout', [authController::class,'logout'])->middleware('auth:sanctum');