<?php

use Illuminate\Support\Facades\Route;
use Larabit\Http\Controllers\ItemsController;

Route::get('items', [ItemsController::class, 'index']);
