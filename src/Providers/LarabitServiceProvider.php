<?php

namespace Dev\Larabit\Providers;

use Dev\Larabit\Services\SomethingToDo\AbstractClass;
use Dev\Larabit\Services\SomethingToDo\InterfaceClass;
use Dev\Larabit\Services\SomethingToDo\Main;
use Dev\Larabit\Services\SomethingToDo\TraitClass;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class LarabitServiceProvider extends ServiceProvider
{
    /**
     * For First
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        if ($this->app->runningInConsole())
        {
            $this->publishes([
                __DIR__ . '/../../config/larabit.php' => config_path('larabit.php'),
            ], 'larabit');

            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');

            //$this->artisan('migrate', ['--database' => 'planet']);
            // $this->commands([LarabitCommand::class]);
        }

        //  laravel connect config file in service provider without copying to config folder
        $this->mergeConfigFrom(__DIR__ . '/../../config/larabit.php', 'larabit');


        // laravel connect language files in service provider without copying to lang folder
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang/', 'larabit');

        // laravel connect views files in service provider without copying to views folder
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'larabit');

        // !!! It is important to connect after receiving all the settings
        Route::middleware('api')
            ->prefix('api')
            ->namespace('Dev\Larabit\Http\Controllers\Api')
            ->group(__DIR__ . '/../../routes/api.php');

        Route::middleware('web')
            ->group(__DIR__ . '/../../routes/web.php');
    }


    /**
     * For Boot
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Main::class, function ($app) {
            return new Main($app);
        });

        $this->app->bind(
            AbstractClass::class,
            Main::class
        );

        $this->app->bind(
          TraitClass::class,
          Main::class
        );

        $this->app->bind(
            InterfaceClass::class,
            Main::class
        );
    }
}
