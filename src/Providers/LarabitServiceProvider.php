<?php

namespace Dev\Larabit\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class LarabitServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function(Request $request) {
            return Limit::perMinute(120)->by($request->user()?->id ?: $request->ip());
        });

        /*$this->publishes([
            __DIR__ . '/../../config/larabit.php' => config_path('larabit.php'),
        ], 'larabit');*/

        //  laravel connect config file in service provider without copying to config folder
        $this->mergeConfigFrom(__DIR__ . '/../../config/larabit.php', 'larabit');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');

        // laravel connect language files in service provider without copying to lang folder
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang/', 'larabit');

        // laravel connect views files in service provider without copying to views folder
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'larabit');

        // !!! It is important to connect after receiving all the settings
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../../routes/api.php');

        Route::middleware('web')
            ->prefix('web')
            ->group(__DIR__ . '/../../routes/web.php');

    }

    /*public function boot()
    {
        if ($this->app->runningInConsole())
        {
            return '';
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/planet.php');
            //$this->artisan('migrate', ['--database' => 'planet']);
            $this->publishes([
                __DIR__ . '/../../config/larabit.php' => config_path('larabit.php'),
            ], 'larabit-config');

            $this->commands([LarabitCommand::class]);
        }

    }*/
}
