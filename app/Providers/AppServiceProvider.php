<?php

namespace App\Providers;

use App\Services\Socialite\AppleProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;

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
        Socialite::extend('apple', function ($app) {
            $config = $app['config']['services.apple'];

            return (new AppleProvider(
                $app['request'],
                $config['client_id'],
                $config['client_secret'] ?? '',
                $config['redirect']
            ))->setConfig($config);
        });
    }
}
