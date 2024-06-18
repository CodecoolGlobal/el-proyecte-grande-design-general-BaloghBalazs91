<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingMethodController;
use App\Http\Controllers\TrainerController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user.profile', [UserController::class, 'profile'])->name('profile');

    # to implement
});
    Route::get('trainings/book/{userId}/{trainingId}', [TrainingController::class, 'joinTrainingById']);

Route::get('training-methods', [TrainingMethodController::class, 'getAll']);
Route::get('training-methods/{training_method_name}', [TrainingMethodController::class, 'getByName']);

// Trainings
Route::get('trainings', [TrainingController::class, 'getAll']);
Route::get('trainings/{id}', [TrainingController::class, 'getById']);
Route::get('trainings/booked-by-user/{user_id}', [TrainingController::class, 'getByUserId']);

// Trainers
Route::get('trainers', [TrainerController::class, 'getAll']);
Route::get('trainers/{id}', [TrainerController::class, 'getById']);

