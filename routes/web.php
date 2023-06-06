<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

Route::get('auth/google/callback', [GoogleController::class, 'callbackFromGoogle'])->name('google.callback');
