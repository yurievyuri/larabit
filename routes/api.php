<?php

use Dev\Larabit\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth routes
Route::prefix(config('larabit.api_prefix'))->group(function() {
    Route::post('auth/register', function(Request $request) {
        return (new AuthController)->register($request);
    });
    Route::post('/auth/unregister', function(Request $request) {
        return (new AuthController)->unregister($request);
    })->middleware('auth:sanctum');
});


Route::prefix(config('larabit.api_prefix'))->middleware('auth:sanctum')->group(function() {
    Route::post('controller/{class}/{method}', function(Request $request, $class, $method) {
        $class = '\\Dev\\Larabit\\Http\\Controllers\\' . ucfirst($class) . 'Controller';
        if ( !class_exists($class) ) throw new \Exception("This request entity $class cannot be processed");
        if ( !method_exists($class, $method) ) throw new \Exception("This request method $method cannot be processed");
        return (new $class)->{$method}($request);
    });
});
