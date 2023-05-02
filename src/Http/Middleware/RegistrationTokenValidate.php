<?php

namespace Dev\Larabit\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationTokenValidate
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
        if ($request->get('registration_token') !== config('larabit.registration_token')) {
            throw new \Exception(__('larabit::auth_controller.validate.reg.exception'));
        }

        return $next($request);
    }
}
