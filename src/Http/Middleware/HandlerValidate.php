<?php

namespace Dev\Larabit\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandlerValidate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->merge(['domain' => $request->getHost()]);
        /*$request->validate([
            'user_id' => 'required|integer',
            'domain' => 'required|string',
            'path' => 'required|string',
            'token' => 'required|string',
            'type' => 'required|string',
        ]);*/

        /*Connection::where('user_id', $request->get('user_id'))
            ->where('domain', $request->get('domain'))
            ->where('path', $request->get('path'));*/

        return $next($request);
    }
}
