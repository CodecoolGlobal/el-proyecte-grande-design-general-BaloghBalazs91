<?php

namespace App\Providers;

use App\Repositories\TrainerRepository\TrainerRepository;
use App\Repositories\TrainerRepository\TrainerRepositoryInterface;
use App\Repositories\TrainingMethodRepository\TrainingMethodRepository;
use App\Repositories\TrainingMethodRepository\TrainingMethodRepositoryInterface;
use App\Repositories\TrainingRepository;
use App\Repositories\TrainingRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TrainingRepositoryInterface::class, TrainingRepository::class);
        $this->app->bind(TrainerRepositoryInterface::class, TrainerRepository::class);
        $this->app->bind(TrainingMethodRepositoryInterface::class, TrainingMethodRepository::class);
    }
}
