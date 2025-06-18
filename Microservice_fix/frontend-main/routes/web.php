<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('produks', ProdukController::class);
Route::resource('customers', CustomerController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');
