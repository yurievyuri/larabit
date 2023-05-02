<?php

namespace Dev\Larabit\Contracts;

/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
interface ActionClassContract
{
    public function __invoke(): string;
}
