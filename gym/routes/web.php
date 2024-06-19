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

Route::middleware('auth')->group(function () {
    Route::get('user.profile', [UserController::class, 'profile'])->name('profile');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});
Route::get('trainings/book/{userId}/{trainingId}', [TrainingController::class, 'joinTrainingById']);

Route::get('training-methods', [TrainingMethodController::class, 'getAll'])->name('training-methods');
Route::get('training-methods/{training_method_name}', [TrainingMethodController::class, 'getByName'])->name('training-method');

// Trainings
Route::controller(TrainingController::class)->group(function () {
    Route::get('/trainings', 'index')->name('training-list');
    Route::get('/trainings/create', 'create');
    Route::get('/trainings/{training}',  'show');
    Route::post('/trainings',  'store');
    Route::get('/trainings/{training}/edit', 'edit');
    Route::patch('/trainings/{training}',  'update');
    Route::delete('/trainings/{training}',  'destroy');
    //Route::get('trainings/booked-by-user/{user_id}', [TrainingController::class, 'getByUserId'])->name('trainings-by-user');
});

// Trainers
Route::get('trainers', [TrainerController::class, 'getAll'])->name('trainers');
Route::get('trainers/{id}', [TrainerController::class, 'getById'])->name('trainer');
#Route::post('trainers/create', [TrainerController::class, 'create']);

