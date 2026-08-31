<?php

namespace Akaunting\Menu;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/menu.php' => config_path('menu.php'),
            __DIR__ . '/Resources/views' => base_path('resources/views/vendor/akaunting/menu'),
        ], 'menu');

        $this->app->singleton('menu', function ($app) {
            return new Menu($app['view'], $app['config']);
        });

        if (file_exists($file = app_path('Support/menus.php'))) {
            require_once($file);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/menu.php', 'menu');

        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'menu');
    }

}
