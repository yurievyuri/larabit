<?php

namespace Dev\Larabit\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserFieldsValidate
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
        $validateUser = Validator::make($request->all(),
            [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|max:255'
            ]);

        if ($validateUser->fails()) {
            abort(config('larabit.http.code.error'), implode(',', $validateUser->errors()->all()));
        }

        return $next($request);
    }
}
