<?php

namespace Dev\Larabit\Http\Controllers;

use Dev\Larabit\Models\Connection;
use Illuminate\Http\Request;

/**
 * @created on 28/04/2023 by yuriyuriev
 * dev.server
 * @soundtrack Pola & Bryson - Night Dawns
 */
class ConnectionController extends Controller
{
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->merge(['domain' => $request->getHost()]);
        $request->validate([
            'user_id' => 'required|integer',
            'domain' => 'required|string',
            'path' => 'required|string',
            'token' => 'required|string',
            'type' => 'required|string',
        ]);

        Connection::where('user_id', $request->get('user_id'))
            ->where('domain', $request->get('domain'))
            ->where('path', $request->get('path'))
            ->delete();

        Connection::create($request->all());

        return $this->sendResponse(true, __('larabit::connection_controller.register.success') );
    }

}
