<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->get('token');
        if (!$token) {
            return response()->json([
                'error' => 'Token not provided.'
            ]);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json([
                'error' => 'Provided token is expired.'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token.'
            ]);
        }
        $user = User::find($credentials->sub);
        $request->auth = $user;

        return $next($request);
    }
}
