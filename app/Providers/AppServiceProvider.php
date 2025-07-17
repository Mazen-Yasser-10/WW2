<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('QrCode', function ($app) {
            return new \SimpleSoftwareIO\QrCode\Generator();
        });
        $this->app->singleton('CurrencyConverter', function ($app) {
            return new \App\Services\CurrencyConverter();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
