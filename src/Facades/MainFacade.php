<?php

declare(strict_types=1);

namespace Dev\Larabit\Facades;

use Dev\Larabit\Services\SomethingToDo\Main;

/**
 * @see \Dev\Larabit\Services\SomethingToDo\Main
 */
final class MainFacade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'something';
    }
}
