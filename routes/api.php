<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;

Route::middleware(['auth:sanctum', 'verified'])->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('/register', [RegisterController::class, 'register'])->name('user.register');

Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/reset-password', [ResetPasswordController::class, 'postPassword'])->name('password.mail');
Route::patch('/reset-password/{token}', [ResetPasswordController::class, 'update'])->name('password.update');

Route::post('/email/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');

Route::get('google-login', [GoogleController::class, 'loginWithGoogle'])->name('google.login');

Route::get('/quotes', [QuoteController::class, 'quotes'])->name('get.quotes');

Route::post('/quote/store', [QuoteController::class, 'store'])->name('store.quote');
