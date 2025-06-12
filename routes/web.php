<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Halaman utama
Route::get('/home', [ProductController::class, 'home'])->name('home');

Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
    Route::get('/', 'index')->name('index');           
    Route::get('/create', 'create')->name('create');   
    Route::post('/store', 'store')->name('store');     
    Route::get('/edit/{id}', 'edit')->name('edit');    
    Route::post('/update/{id}', 'update')->name('update'); 
    Route::get('/show/{id}', 'show')->name('show');     
    Route::post('/destroy/{id}', 'destroy')->name('destroy'); 
});
