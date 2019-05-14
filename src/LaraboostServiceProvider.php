<?php

namespace Laraboost;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaraboostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerResources();

        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laraboost');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laraboost');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laraboost.php' => config_path('laraboost.php'),
            ], 'config');
        }
    }

    public function register()
    {
        if (!defined('LARABOOST_PATH')) {
            define('LARABOOST_PATH', realpath(__DIR__ . '/../'));
        }

        $this->configure();
    }

    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laraboost.php',
            'laraboost'
        );
    }

    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laraboost');
    }

    protected function registerRoutes()
    {
        Route::group([
            'prefix' => 'laraboost',
            'namespace' => 'Laraboost\Http\Controllers',
            // 'middleware' => ['web', 'auth'],
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });

        Route::group([
            'prefix' => 'laraboost/api',
            'namespace' => 'Laraboost\Http\Controllers',
            'middleware' => ['auth:api'],
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }
}
