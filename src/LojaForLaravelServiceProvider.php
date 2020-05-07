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
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'loja);
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'loja');
        //$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if (file_exists($file = app_path('src/Helpers/ProductHelper.php'))) {
            require $file;
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config/config.php' => config_path('loja.php')], 'config');

            // Publishing the migrations.
            $this->publishes([
                __DIR__.'/../database/migrations/create_products_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_products_table.php'),
                __DIR__.'/../database/migrations/create_orders_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_orders_table.php'),
                // you can add any number of migrations here
            ], 'migrations');

            // Publishing the views.
            $this->publishes([__DIR__.'/../resources/views' => resource_path('views/vendor/loja')], 'views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/loja'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/loja'),
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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'loja');

        // Register the main class to use with the facade
        $this->app->singleton('loja', function () {
            return new LojaForLaravel;
        });
    }
}
