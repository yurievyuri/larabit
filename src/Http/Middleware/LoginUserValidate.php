<?php

namespace Dev\Larabit\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @created on 02/05/2023 by yuriyuriev
 * larabit
 */
class LoginUserValidate
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
        $user = (new User)
            ->where('email', $request->get('email'))
            ->where('name', $request->get('name'))
            ->first();
        if (!$user) {
            abort(config('larabit.http.code.error'), __('larabit::auth_controller.login.fail'));
        }

        return $next($request);
    }
}
