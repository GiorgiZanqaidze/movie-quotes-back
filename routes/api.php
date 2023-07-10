<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UpdateUserController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::get('/user', function (Request $request) {return $request->user(); });
});

Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('google-login', [GoogleController::class, 'loginWithGoogle'])->name('google.login');
Route::post('/reset-password', [ResetPasswordController::class, 'postPassword'])->name('password.reset');
Route::patch('/reset-password/{token}', [ResetPasswordController::class, 'update'])->name('password.update');

Route::controller(RegisterController::class)->group(function () {
	Route::post('/email/verify/{token}', 'verifyAccount')->name('user.verify');
	Route::post('/register', 'register')->name('user.register');
	Route::post('/resend/email/verify/{token}', 'resendVerificationEmail')->name('email.resend');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::get('/genres', [GenresController::class, 'index'])->name('genres.get');
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
	Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.post');
	Route::post('/like/quote', [LikeController::class, 'store'])->name('like.post');
	Route::post('/dislike/quote', [LikeController::class, 'destroy'])->name('like.destroy');

	Route::controller(UpdateUserController::class)->group(function () {
		Route::post('/update/avatar/{user}', 'updateAvatar')->name('avatar.update');
		Route::post('/update/user/{user}', 'updateUser')->name('user.update');
		Route::get('/notifications/mark-as-read', 'updateNotifications')->name('notifications.update');
		Route::post('/update-email/{token}', 'updateUserEmail')->name('email.verify');
	});

	Route::controller(QuoteController::class)->group(function () {
		Route::get('/quotes', 'index')->name('quotes.get');
		Route::post('/quote/store', 'store')->name('quote.store');
		Route::delete('/quote/destroy/{quote}', 'destroy')->name('quote.destroy');
		Route::post('/quote/update/{id}', 'update')->name('quote.update');
	});

	Route::controller(MovieController::class)->group(function () {
		Route::get('/user-movies', 'index')->name('user.movies');
		Route::get('/all-movies', 'allMovies')->name('movies.get');
		Route::post('/movie/store', 'store')->name('movie.store');
		Route::delete('/movie/destroy/{movie}', 'destroy')->name('movie.destroy');
		Route::post('/movie/update/{movie}', 'update')->name('movie.update');
		Route::get('/movie/{id}', 'get')->name('movie.get');
	});
});
