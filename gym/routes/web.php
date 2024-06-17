<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/',function (){return view('home');})->name('home');

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('login', [UserController::class, 'login']);


Route::post('register', [UserController::class, 'registerTrainee']);

Route::middleware('auth')->group(function () {
    Route::get('user.profile', [UserController::class, 'profile'])->name('profile');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});


Route::get('training-methods', [\App\Http\Controllers\TrainingMethodController::class, 'getAll']);
Route::get('training-methods/{training_method_name}', [\App\Http\Controllers\TrainingMethodController::class, 'getByName']);


