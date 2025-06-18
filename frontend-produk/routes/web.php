<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Produk;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('produk/create',[ProdukController::class,'create'])
->name('produks.create');
Route::post('produk',[ProdukController::class,'store'])
->name('produks.store');
Route::get('produk',[ProdukController::class,'index'])
->name('produks.index');
Route::get('produk/{id}/edit',[ProdukController::class,'edit'])
->name('produks.edit');
Route::put('produk/{id}',[ProdukController::class,'update'])
->name('produks.update');
Route::delete('produk/{id}',[ProdukController::class,'destroy'])
->name('produks.destroy');
