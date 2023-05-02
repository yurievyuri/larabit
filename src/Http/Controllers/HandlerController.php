<?php

namespace Dev\Larabit\Http\Controllers;

use Dev\Larabit\Models\Connection;
use Illuminate\Http\Request;

class HandlerController extends Controller
{
    public function register(Request $request, $method): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(true, __('larabit::handler_controller.register.success') );
    }

}
