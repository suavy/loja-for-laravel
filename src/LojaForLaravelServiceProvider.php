<?php

namespace Suavy\LojaForLaravel;

use Illuminate\Support\ServiceProvider;

class LojaForLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'loja-for-laravel');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'loja-for-laravel');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'../../routes/web.php');

        if (file_exists($file = app_path('src/Helpers/ProductHelper.php'))) {
            require $file;
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('loja-for-laravel.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/loja-for-laravel'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/loja-for-laravel'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/loja-for-laravel'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'loja-for-laravel');

        // Register the main class to use with the facade
        $this->app->singleton('loja-for-laravel', function () {
            return new LojaForLaravel;
        });
    }
}
