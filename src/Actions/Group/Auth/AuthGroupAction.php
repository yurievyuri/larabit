<?php

namespace Dev\Larabit\Actions\Group\Auth;

use Illuminate\Http\Client\Request;

/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
class AuthGroupAction
{
    public function __construct(
        private ValidateRegistrationTokenAction $regToken,
        private ValidateUserAction $user
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(Request $request): void
    {
        ($this->regToken)($request);
        ($this->user)($request);
    }
}
