<?php

namespace Larabit\Providers;

use Illuminate\Support\ServiceProvider;
use Larabit\Console\Commands\LarabitCommand;

class LarabitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../config/larabit.php.php' => config_path('larabit.php'),
            ]);

            $this->commands([
                LarabitCommand::class,
            ]);

            exec('php ' . __DIR__ . '/../../artisan vendor:publish --provider="Larabit\Providers\LarabitServiceProvider\"');
        }

        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }
}
