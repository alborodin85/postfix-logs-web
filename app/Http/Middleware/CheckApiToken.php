<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    public function handle(Request $request, \Closure $next): Response
    {
        if (!$request->get('endpoint_api_token', false)) {
            abort(401);
        }
        if ($request->get('endpoint_api_token', false) != config('auth.endpoint_api_token')) {
            abort(401);
        }
        /** @var Response $response */
        $response = $next($request);

        return $response;
    }
}
