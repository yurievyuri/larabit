<?php

namespace Dev\Larabit\Http\Controllers;

use App\Models\User;
use Dev\Larabit\Models\Connection;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function register(Request $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        $token = $user->createToken(config('larabit.token_key'))->plainTextToken;
        if ($token) {
            $user->setRememberToken($token);
            $user->save();
        }

        return $this->sendResponse([
            'token' => $token,
            'user_id' => $user->id,
        ], __('larabit::auth_controller.register.success'));
    }

    /**
     * @throws Exception
     */
    public function unregister(Request $request): JsonResponse
    {
        $user = User::where('email', $request->get('email'));
        $arUsers[] = $user->first()->toArray();
        if (!$user->delete()) {
            return $this->sendError(__('larabit::auth_controller.unregister.fail'));
        }
        Connection::where('user_id', $arUsers)->delete();
        return $this->sendResponse(true, __('larabit::auth_controller.unregister.success'));
    }

    /**
     * Login The User
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function login(Request $request): JsonResponse
    {
        return $this->sendResponse(['token' => Auth::user()->getRememberToken()],
            __('larabit::auth_controller.login.success'));
    }

}
