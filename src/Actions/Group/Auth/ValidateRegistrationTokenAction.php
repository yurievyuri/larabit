<?php

namespace Dev\Larabit\Actions\Group\Auth;

use Dev\Larabit\Contracts\AuthActionContract;
use Exception;
use Illuminate\Http\Client\Request;

/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
class ValidateRegistrationTokenAction implements AuthActionContract
{
    /**
     * @throws Exception
     */
    public function __invoke(Request $request): string
    {
        if ($request->get('registration_token') !== config('larabit.registration_token')) {
            throw new Exception(__('larabit::auth_controller.validate.reg.exception'));
        }
    }
}
