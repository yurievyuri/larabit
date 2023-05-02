<?php

namespace Dev\Larabit\Services\SomethingToDo;

/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
class ChildClass extends Main
{
    public function getMain(): string
    {
        return 'child';
    }
}
