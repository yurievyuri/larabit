<?php

namespace Dev\Larabit\Actions;

class ActionClass implements \Dev\Larabit\Contracts\ActionClassContract
{
    public function __invoke(): string
    {
        return view('larabit::index', [
            'data' => [1,2,3],
        ]);
    }
    public function handle(): string
    {
        return 'Hello Action Class';
    }
}
