<?php


use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::prefix('login')->name('login')->group(function (){
    Route::get('', [AuthController::class, 'show'])->name('');
    Route::post('', [AuthController::class, 'login'])->name('.attempt');
});

Route::prefix('register')->name('register')->group(function (){
    Route::get('', [RegisterController::class, 'showRegisterForm'])->name('');
    Route::post('', [RegisterController::class, 'register'])->name('.perform');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

