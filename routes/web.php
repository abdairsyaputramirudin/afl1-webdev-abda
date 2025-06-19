<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth')->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::post('/update/{cart}', [CartController::class, 'update'])->name('update');
    Route::post('/remove/{cart}', [CartController::class, 'remove'])->name('remove');
});

Route::middleware('auth')->prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'show'])->name('index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');
});

Route::middleware('auth')->prefix('order')->name('order.')->group(function () {
    Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
});

Route::match(['get', 'post'], '/login', [LoginController::class, 'form'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
