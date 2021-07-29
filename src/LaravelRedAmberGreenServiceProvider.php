<?php

namespace Ontherocksoftware\LaravelRedAmberGreen;

use Illuminate\Support\ServiceProvider;

class LaravelRedAmberGreenServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ontherocksoftware');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'ontherocksoftware');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->publishes([
            __DIR__.'/../config/laravelredambergreen.php' => config_path('laravelredambergreen.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelredambergreen.php', 'laravelredambergreen');

        // Register the service the package provides.
        $this->app->singleton('laravelredambergreen', function ($app) {
            return new LaravelRedAmberGreen();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelredambergreen'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelredambergreen.php' => config_path('laravelredambergreen.php'),
        ], 'laravelredambergreen.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/ontherocksoftware'),
        ], 'laravelredambergreen.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/ontherocksoftware'),
        ], 'laravelredambergreen.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/ontherocksoftware'),
        ], 'laravelredambergreen.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
