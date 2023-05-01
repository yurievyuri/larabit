<?php

namespace Dev\Larabit\Http\Controllers;

use Dev\Larabit\Models\Connection;
use Illuminate\Http\Request;

class HandlerController extends Controller
{
    public function register(Request $request, $method): \Illuminate\Http\JsonResponse
    {
        $request->merge(['domain' => $request->getHost()]);
        /*$request->validate([
            'user_id' => 'required|integer',
            'domain' => 'required|string',
            'path' => 'required|string',
            'token' => 'required|string',
            'type' => 'required|string',
        ]);*/

        /*Connection::where('user_id', $request->get('user_id'))
            ->where('domain', $request->get('domain'))
            ->where('path', $request->get('path'));*/


        return $this->sendResponse(true, __('larabit::handler_controller.register.success') );
    }

}
