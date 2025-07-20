<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        URL::forceRootUrl(config('app.url'));

        if (app()->environment('production')) {
            // Force HTTPS in production
            URL::forceScheme('https');
        }
    }
}
