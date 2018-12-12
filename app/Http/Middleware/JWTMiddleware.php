<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \App\Hamsaa\Exceptions\AuthExceptions\TokenExpiredException
     * @throws \App\Hamsaa\Exceptions\AuthExceptions\TokenInvalidException
     * @throws \App\Hamsaa\Exceptions\AuthExceptions\TokenNotProvidedException
     */
    public function handle($request, Closure $next)
    {
        try {
            $this->auth->parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $exception) {
            throw new \App\Hamsaa\Exceptions\AuthExceptions\TokenExpiredException;
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $exception) {
            throw new  \App\Hamsaa\Exceptions\AuthExceptions\TokenInvalidException;
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $exception) {
            throw new \App\Hamsaa\Exceptions\AuthExceptions\TokenNotProvidedException;
        }

        return $next($request);
    }
}
