<?php

namespace Dev\Larabit\Contracts;

use Illuminate\Http\Client\Request;

/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
interface AuthActionContract
{
    public function __invoke(Request $request): string;
}
