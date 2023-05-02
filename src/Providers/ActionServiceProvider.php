<?php

namespace Dev\Larabit\Providers;

/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
class ActionServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public array $bindings = [
        \Dev\Larabit\Contracts\ActionClassContract::class => \Dev\Larabit\Actions\ActionClass::class,
        \Dev\Larabit\Contracts\AuthActionContract::class => \Dev\Larabit\Actions\Group\Auth\AuthGroupAction::class
    ];
}
