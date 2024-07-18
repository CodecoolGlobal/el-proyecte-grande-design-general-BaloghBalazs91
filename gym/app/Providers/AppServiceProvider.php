<?php

namespace App\Providers;

use App\Repositories\TrainingRepository;
use App\Repositories\TrainingRepositoryInterface;
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
        $this->app->bind(TrainingRepositoryInterface::class, TrainingRepository::class);
    }
}
