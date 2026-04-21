<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cita;
use App\Observers\CitaObserver;

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
        Cita::observe(CitaObserver::class);
    }
}
