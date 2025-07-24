<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController; 
use App\Models\category;
use App\Models\product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);
Route::get('/', [HomeController::class, 'home'])->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('/category', CategoryController::class)->middleware('auth');
Route::resource('/product', ProductController::class)->middleware('auth');

Route::get ('/review', [HomeController::class, 'review'])->name('review'); 
Route::post('/storereview', [HomeController::class, 'storereview'])->name('storereview');

Route::post('/search', [HomeController::class, 'search'])->name('search');



Route::get('/cart',[CartController::class,'cart'])->name('cart')->middleware('auth');
Route::post('/addtocart',[CartController::class,'addtocart'])->name('addtocart')->middleware('auth');;
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{productid}', [CartController::class, 'remove'])->name('cart.remove');


Route::get('/order',[HomeController::class,'order'])->name('order');
Route::post('/storeorder', [HomeController::class, 'storeorder'])->name('storeorder')->middleware('auth');
Route::get('/pre-order', [HomeController::class, 'preOrder'])->name('pre-order')->middleware('auth');




