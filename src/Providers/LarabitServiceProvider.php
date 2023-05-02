<?php

namespace Dev\Larabit\Providers;

use Dev\Larabit\Services\SomethingToDo\Main;
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

        $this->mergeConfigFrom(__DIR__ . '/../../config/larabit.php', 'larabit');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang/', 'larabit');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'larabit');


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
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        //$this->app->register(ActionServiceProvider::class);
        $this->app->registerDeferredProvider(ActionServiceProvider::class);

        $this->app->bind('something', Main::class);
    }
}
