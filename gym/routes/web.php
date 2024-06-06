<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [UserController::class, 'login']);

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('register', [UserController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('profile', [UserController::class, 'profileData'])->name('profile');
});


