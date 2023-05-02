<?php

namespace Dev\Larabit\Console\Commands;

use Dev\Larabit\Contracts\ActionClassContract;

/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
class RegisterUserCommand
{
    protected string $description = 'Register a new user';

    public function __invoke(ActionClassContract $action): int
    {
        $action([
            'name' => 'John Doe',
            'email' => 'jonny@dor.com'
        ]);

        return 0;
    }
}
