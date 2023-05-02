<?php

use Dev\Larabit\Http\Controllers\AuthController;
use Dev\Larabit\Http\Controllers\HandlerController;
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
Route::prefix(config('larabit.api.prefix'))->group(function() {
    Route::post(config('larabit.routes.auth.register'), function(Request $request) {
        return (new AuthController)->register($request);
    });
    Route::post(config('larabit.routes.auth.unregister'), function(Request $request) {
        return (new AuthController)->unregister($request);
    })->middleware('auth:sanctum');
});

Route::prefix(config('larabit.api.prefix'))->middleware('auth:sanctum')->group(function() {
    Route::post(config('larabit.routes.controller.connection') . '/{method}', function(Request $request, $method) {
        return (new \Dev\Larabit\Http\Controllers\ConnectionController)->{$method}($request);
    });
    Route::post(config('larabit.routes.controller.handler') . '/{method}', function(Request $request, $method) {
        return (new HandlerController)->register($request, $method);
    });
});
