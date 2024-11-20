<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Web\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/categories', CategoriesController::class .'@index')->name('categories.index');
    Route::get('/categories/create', CategoriesController::class . '@create')->name('categories.create');
    Route::post('/categories/store', CategoriesController::class .'@store')->name('categories.store');
    Route::get('/categories/{category}', CategoriesController::class .'@show')->name('categories.show');
    Route::get('/categories/{category}/edit', CategoriesController::class .'@edit')->name('categories.edit');
    Route::put('/categories/{category}', CategoriesController::class .'@update')->name('categories.update');
    Route::delete('/categories/{category}', CategoriesController::class .'@destroy')->name('categories.destroy');
    Route::get('/products',ProductController::class .'@index')->name('products.index');
    Route::post('/products',ProductController::class .'@store')->name('products.store');
//    Route::get('/products/{product}',ProductController::class .'@show')->name('products.show');
    Route::put('/products/{product}',ProductController::class .'@update')->name('products.update');
    Route::delete('/products/{product}',ProductController::class .'@destroy')->name('products.destroy');
    Route::get('/products/create',ProductController::class .'@create')->name('products.create');
    Route::get('/products/{product}/edit', ProductController::class . '@edit')->name('products.edit');
});

