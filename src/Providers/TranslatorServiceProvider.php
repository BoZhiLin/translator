<?php

namespace Bozhilin\Translator\Providers;

use Illuminate\Support\ServiceProvider;

class TranslatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('translate', function () {
            return new \Bozhilin\Translator\Builder;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $path = __DIR__.'/../../config/translate.php';
        
        $this->publishes([$path => config_path('translate.php')], 'config');

        $this->mergeConfigFrom($path, 'translate');
    }
}
