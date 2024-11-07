<?php

namespace Rhodiz\Config\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->loadViewsFrom(__DIR__.'/../Resources/views', 'rhodiz_config');

        $this->loadRoutesFrom(__DIR__.'/../Routes/routes.php');

        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'rhodiz_config');

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/Config/system.php', 'core'
        );
    }
}
