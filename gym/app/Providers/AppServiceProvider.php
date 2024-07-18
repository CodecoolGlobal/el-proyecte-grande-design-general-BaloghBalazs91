<?php

namespace App\Providers;

use App\Repositories\TrainerRepository\TrainerRepository;
use App\Repositories\TrainerRepository\TrainerRepositoryInterface;
use App\Repositories\TrainingMethodRepository\TrainingMethodRepository;
use App\Repositories\TrainingMethodRepository\TrainingMethodRepositoryInterface;
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
        $this->app->bind(TrainerRepositoryInterface::class, TrainerRepository::class);
        $this->app->bind(TrainingMethodRepositoryInterface::class, TrainingMethodRepository::class);
    }
}
