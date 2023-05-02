<?php

namespace Dev\Larabit\Http\Controllers;
use Dev\Larabit\Actions\ActionClass;
use Dev\Larabit\Contracts\ActionClassContract;
use Illuminate\Http\Request;
/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
class ControllerClass extends \App\Http\Controllers\Controller
{
    public function __invoke(Request $request, ActionClassContract $action)
    {
        //return MainFacade::get();
        return view('larabit::index', [
            'data' => $action(),
        ]);
    }
}
