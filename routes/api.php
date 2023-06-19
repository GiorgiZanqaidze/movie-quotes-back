<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::get('/user', function (Request $request) {return $request->user(); });
});

Route::post('/register', [RegisterController::class, 'register'])->name('user.register');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('google-login', [GoogleController::class, 'loginWithGoogle'])->name('google.login');

Route::post('/reset-password', [ResetPasswordController::class, 'postPassword'])->name('password.mail');
Route::patch('/reset-password/{token}', [ResetPasswordController::class, 'update'])->name('password.update');
Route::post('/email/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

	Route::get('/quotes', [QuoteController::class, 'quotes'])->name('get.quotes');

	Route::post('/quote/store', [QuoteController::class, 'store'])->name('store.quote');

	Route::delete('/quote/destroy/{id}', [QuoteController::class, 'destroy'])->name('destroy.quote');

	Route::post('/quote/update/{id}', [QuoteController::class, 'update'])->name('update.quote');

	Route::post('/comment/store', [CommentController::class, 'store'])->name('post.comment');

	Route::post('/like/quote', [LikeController::class, 'store'])->name('store.like');

	Route::post('/dislike/quote', [LikeController::class, 'destroy'])->name('destroy.like');

	Route::get('/movies', [MovieController::class, 'movies'])->name('get.movies');

	Route::get('/movie/{id}', [MovieController::class, 'movie'])->name('get.movie');
});
