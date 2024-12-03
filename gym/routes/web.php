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
    Route::get('user/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');



// Training methods
Route::controller(TrainingMethodController::class)->group(function () {
    Route::get('training-methods', 'index');
    Route::get('training-methods/create', 'create');
    Route::post('training-methods', 'store');
    Route::get('training-methods/{trainingMethod:name}', 'show');
    Route::get('training-methods/{trainingMethod:name}/edit', 'edit');
    Route::patch('training-methods/{trainingMethod}', 'update');
    Route::delete('training-methods/{trainingMethod}', 'destroy');
});

// Trainings
Route::controller(TrainingController::class)->group(function () {
    Route::get('/trainings', 'indexByWeek')->name('training-list');
    Route::get('/trainings/create', 'create');
    Route::get('/trainings/{training}',  'show');
    Route::post('/trainings',  'store');
    Route::get('/trainings/{training}/edit', 'edit')
        ->middleware('auth')
        ->can('edit', 'training');
    Route::patch('/trainings/{training}',  'update');
    Route::delete('/trainings/{training}',  'destroy');

    Route::patch('trainings/book/{user}/{training}', 'joinTrainingById')
        ->name('joinTrainingById')
        ->middleware('auth')
        ->can('join', 'training');

    Route::patch('trainings/cancel/{user}/{training}', 'cancelTrainingById')
        ->name('cancelTrainingById')
        ->middleware('auth')
        ->can('cancel', 'training');
});

// Trainers
Route::controller(TrainerController::class)->group(function () {
    Route::get('trainers', 'index');
    Route::get('trainers/create', 'create');
    Route::get('trainers/{id}',  'show');
    Route::post('trainers', 'store');
    Route::get('trainers/{id}/edit', 'edit');
    Route::patch('trainers/{trainer}', 'update');
    Route::delete('trainers/{trainer}', 'destroy');
});



