<?php

namespace Dev\Larabit\Http\Controllers;

use Dev\Larabit\Models\Connection;
use Dev\Larabit\Http\Resources\ControllerResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = Connection::paginate(100);
        return ControllerResource::collection($model);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response = [
            'success' => true,
            'data' => [1, 2, 3],
            'message' => static::class . '::' . __FUNCTION__
        ];

        return response()->json($response, config('larabit.http.code.ok'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = [
            'success' => true,
            'data' => [1, 2, 3],
            'message' => static::class . '::' . __FUNCTION__
        ];

        return response()->json($response, config('larabit.http.code.ok'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Model $model)
    {
        $response = [
            'success' => true,
            'data' => [1, 2, 3],
            'message' => static::class . '::' . __FUNCTION__
        ];

        return response()->json($response, config('larabit.http.code.ok'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConnectionController $driver)
    {
        $response = [
            'success' => true,
            'data' => [1, 2, 3],
            'message' => static::class . '::' . __FUNCTION__
        ];

        return response()->json($response, config('larabit.http.code.ok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Model $model)
    {
        $model::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        $response = [
            'success' => true,
            'data' => $request->all(),
            'message' => static::class . '::' . __FUNCTION__
        ];

        return response()->json($response, config('larabit.http.code.ok'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $model)
    {
        $response = [
            'success' => true,
            'data' => [1, 2, 3],
            'message' => static::class . '::' . __FUNCTION__
        ];

        return response()->json($response, config('larabit.http.code.ok'));
    }


    public function sendResponse($result, $message, int $code = null): JsonResponse
    {
        if ( !$code ) {
            $code = config('larabit.http.code.ok');
        }
        return response()->json([
            'success' => !empty($result),
            'data' => $result,
            'message' => $message,
        ], $code);
    }

    /**
     * return error response.
     *
     * @param $message
     * @param int|null $code
     * @return JsonResponse
     */
    public function sendError($message, int $code = null): JsonResponse
    {
        if ( !$code ) {
            $code = config('larabit.http.code.error');
        }
        return response()->json([
            'success' => false,
            'message' => is_countable($message) && is_array($message) ? implode(',', $message) : $message,
        ], $code);
    }

}
