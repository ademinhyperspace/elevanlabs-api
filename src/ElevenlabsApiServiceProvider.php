<?php

namespace Shahinyanm\ElevenlabsApi;

use Illuminate\Support\ServiceProvider;
use Shahinyanm\ElevenlabsApi\Services\Elevenlabs\ElevenlabsConvertService;

class ElevenlabsApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/elevenlabs.php' => config_path('elevenlabs-api.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/elevenlabs.php', 'elevenlabs-api');

        // Register the main class to use with the facade
        $this->app->singleton('elevenlabs-api', function () {
            return new ElevenlabsConvertService;
        });
    }
}
