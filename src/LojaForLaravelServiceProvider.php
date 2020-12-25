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
        $this->loadRoutesFrom(__DIR__.'/../routes/backpack.php');

        if (file_exists($file = app_path('src/Helpers/ProductHelper.php'))) {
            require $file;
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config/config.php' => config_path('loja.php')], 'config');

            // Publishing the migrations.
            $this->publishes([
                //__DIR__.'/../database/migrations/' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_orders_table.php'),
                __DIR__.'/../database/migrations/create_loja_attribute_attribute_set_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 2).'_create_loja_attribute_attribute_set_table.php'),
                __DIR__.'/../database/migrations/create_loja_attribute_sets_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 0).'_create_loja_attribute_sets_table.php'),
                __DIR__.'/../database/migrations/create_loja_attribute_values_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 2).'_create_loja_attribute_values_table.php'),
                __DIR__.'/../database/migrations/create_loja_attributes_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 1).'_create_loja_attributes_table.php'),
                __DIR__.'/../database/migrations/create_loja_categories_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 0).'_create_loja_categories_table.php'),
                __DIR__.'/../database/migrations/create_loja_collections_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 0).'_create_loja_collections_table.php'),
                __DIR__.'/../database/migrations/create_loja_orders_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 1).'_create_loja_orders_table.php'),
                __DIR__.'/../database/migrations/create_loja_order_product_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 2).'_create_loja_order_product_table.php'),
                __DIR__.'/../database/migrations/create_loja_order_statuses_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 0).'_create_loja_order_statuses_table.php'),
                __DIR__.'/../database/migrations/create_loja_products_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 1).'_create_loja_products_table.php'),
                __DIR__.'/../database/migrations/create_loja_order_product_attribute_value_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 3).'_create_loja_order_product_attribute_value_table.php'),
                __DIR__.'/../database/migrations/create_loja_taxes_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 0).'_create_loja_taxes_table.php'),
                __DIR__.'/../database/migrations/create_loja_countries_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 0).'_create_loja_countries_table.php'),
                __DIR__.'/../database/migrations/create_loja_address_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 1).'_create_loja_address_table.php'),
                __DIR__.'/../database/migrations/seed_loja_settings.php.stub' => database_path('migrations/'.date('Y_m_d_His', time() + 0).'_seed_loja_settings.php'),

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

        // Register the model factories
        $this->app->make('Illuminate\Database\Eloquent\Factories\Factory')->load(__DIR__.'/../database/factories');

        // Register the helper functions
        $this->loadHelpers();
    }

    /**
     * Load the Loja helper methods.
     */
    public function loadHelpers()
    {
        $path = __DIR__.'/Helpers/ProductHelper.php';
        if (file_exists($path)) {
            require_once $path;
        }
    }
}
