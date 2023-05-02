<?php

namespace Dev\Larabit\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DuplicateUserValidate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::attempt($request->only(['name', 'email', 'password']))) {
            abort(config('larabit.http.code.error'), __('larabit::auth_controller.validate.user.exception'));
        }

        return $next($request);
    }
}
