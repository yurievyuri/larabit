<?php

namespace Dev\Larabit\Actions\Group\Auth;

use Dev\Larabit\Contracts\AuthActionContract;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
class ValidateUserAction implements AuthActionContract
{
    /**
     * @throws \Exception
     */
    public function __invoke(Request $request): string
    {
        $validateUser = Validator::make($request->all(),
            [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|max:255'
            ]);

        if ($validateUser->fails()) {
            throw new \Exception(implode(',', $validateUser->errors()->all()));
        }

        //if (!$attempt) return;
        //if (Auth::attempt($request->only(['email', 'password']))) return;

        throw new \Exception(__('larabit::auth_controller.validate.user.exception'));
    }
}
