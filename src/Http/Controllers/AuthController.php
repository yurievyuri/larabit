<?php

namespace Dev\Larabit\Http\Controllers;

use App\Models\User;
use Dev\Larabit\Models\Connection;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $this->validateRegistrationToken($request);
        $this->validateUser($request);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        $token = $user->createToken(config('larabit.token_key'))->plainTextToken;
        if ( $token ) {
            $user->setRememberToken($token);
            $user->save();
        }

        return $this->sendResponse([
            'token' => $token,
            'user_id' => $user->id,
        ],__('larabit::auth_controller.register.success') );
    }

    /**
     * @throws Exception
     */
    public function unregister(Request $request): JsonResponse
    {
        $user = User::where('email', $request->get('email'));
        $arUsers[] = $user->first()->toArray();
        if ( !$user->delete() ) {
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
        $this->validateUser($request, true);
        $user = User::where('email', $request->get('email'))->first();
        if ( !$user ){
            return $this->sendError(__('larabit::auth_controller.login.fail'));
        }
        return $this->sendResponse(['token' => $user->getRememberToken()],
            __('larabit::auth_controller.login.success'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function user(Request $request): JsonResponse
    {
        $this->validateUser($request, true);
        $user = User::where('email', $request->get('email'))->first();
        if ( !$user ){
            return $this->sendError(__('larabit::auth_controller.login.fail'));
        }
        return $this->sendResponse(['token' => $user->getRememberToken()],
            __('larabit::auth_controller.login.success'));
    }

    /**
     * @throws Exception
     */
    private function validateUser(Request $request, bool $attempt = false): void
    {
        $validateUser = Validator::make($request->all(),
            [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|max:255'
            ]);

        if ($validateUser->fails()) {
            throw new Exception(implode(',', $validateUser->errors()->all()));
        }

        if (!$attempt) return;
        if (Auth::attempt($request->only(['email', 'password']))) return;

        throw new Exception(__('larabit::auth_controller.validate.user.exception'));
    }

    /**
     * @throws Exception
     */
    private function validateRegistrationToken(Request $request): void
    {
        if ($request->get('registration_token') !== config('larabit.registration_token')) {
            throw new Exception(__('larabit::auth_controller.validate.reg.exception'));
        }
    }
}
