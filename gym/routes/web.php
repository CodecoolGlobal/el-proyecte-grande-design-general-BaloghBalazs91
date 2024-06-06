<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/',function (){return view('home');})->name('home');

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [UserController::class, 'login']);

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('register', [UserController::class, 'registerTrainee']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user.profile', [UserController::class, 'profile'])->name('profile');
});


