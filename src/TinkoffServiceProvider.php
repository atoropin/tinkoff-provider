<?php

namespace TinkoffProvider;

use TinkoffProvider\Tinkoff;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Class TinkoffServiceProvider
 * @package App\Providers
 */
class TinkoffServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerPublishing();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::namespace('TinkoffProvider\Controllers')
            ->prefix(config('tinkoff.routePrefix'))
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/routes.php');
            });
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/tinkoff.php' => config_path('tinkoff.php')
        ], 'tinkoff-config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('tinkoff', function() {
            return new Tinkoff(
                config('tinkoff.terminalKey'),
                config('tinkoff.password'),
                config('tinkoff.baseUrl'),
                config('tinkoff.notificationUrl'),
                config('tinkoff.successUrl'),
                config('tinkoff.failUrl')
            );
        });
    }
}
