<?php

namespace App\Http\Middleware;

use Closure;

class GeneralMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!$request->wantsJson()) {
            return response()->json([
                'error' => 'Not enough need a header. Accept: application/json'
            ]);
        }
        return $next($request);
    }
}
