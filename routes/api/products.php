<?php

use App\Http\Controllers\Api\Products\ProductsController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->name('products')->group(function (){
    Route::get('',[ProductsController::class,'index'])->name('index');
    Route::get('es',[ProductsController::class,'es'])->name('es');
});

