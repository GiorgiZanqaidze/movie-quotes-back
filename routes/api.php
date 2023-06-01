<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/user', function (Request $request) {
	return auth()->user();
});

Route::post('/register', [RegisterController::class, 'register'])->name('user.register');

Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/reset-password', [ResetPasswordController::class, 'postPassword'])->name('password.mail');
Route::patch('/reset-password/{token}', [ResetPasswordController::class, 'update'])->name('password.update');

Route::post('/email/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');
