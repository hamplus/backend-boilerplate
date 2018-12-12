<?php

namespace Tests\Unit\Middleware;

use App\Hamsaa\Exceptions\AuthExceptions\TokenExpiredException;
use App\Hamsaa\Exceptions\AuthExceptions\TokenInvalidException;
use App\Hamsaa\Exceptions\AuthExceptions\TokenNotProvidedException;
use App\Http\Middleware\JWTMiddleware;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;
use Tymon\JWTAuth\JWTAuth;

class JWTMiddlewareTest extends TestCase
{
    /** @test */
    public function does_jwt_middleware_throw_exception_if_token_is_invalid()
    {
        $this->fireJWTMiddleware(TokenInvalidException::class, new NotValidAuthenticator());
    }

    /** @test */
    public function does_jwt_middleware_throw_exception_if_token_expired()
    {
        $this->fireJWTMiddleware(TokenExpiredException::class, new ExpiredAuthenticator());
    }

    /** @test */
    public function does_jwt_middleware_throw_exception_if_token_not_provided()
    {
        $this->fireJWTMiddleware(TokenNotProvidedException::class, new NotProvidedAuthenticator());
    }

    /** @test */
    public function does_jwt_middleware_work_with_passed_authentication()
    {
        $request = Mockery::mock(Request::class);

        // Pass it to the middleware
        $authenticator = new ValidAuthenticator;

        $request = Mockery::mock(Request::class);

        $auth = Mockery::mock(JWTAuth::class)->makePartial()
            ->shouldReceive('parseToken')->andReturn($authenticator)->once()->getMock();

        $middleware = new JWTMiddleware($auth);

        // making sure next middleware is called
        $mock = Mockery::mock('nextMiddleware')
            ->shouldReceive('call')
            ->once()
            ->getMock();

        $middleware->handle($request, function () use ($mock) {
            $mock->call();
        });
    }

    private function fireJWTMiddleware(string $exception, AuthenticatorInterface $authenticator)
    {
        $this->expectException($exception);

        $request = Mockery::mock(Request::class);

        $auth = Mockery::mock(JWTAuth::class)->makePartial()
            ->shouldReceive('parseToken')->andReturn($authenticator)->once()->getMock();

        $middleware = new JWTMiddleware($auth);

        $middleware->handle($request, function () {
        });
    }
}

interface AuthenticatorInterface
{
    public function authenticate();
}

class NotValidAuthenticator implements AuthenticatorInterface
{
    public function authenticate()
    {
        throw new \Tymon\JWTAuth\Exceptions\TokenInvalidException;
    }
}

class NotProvidedAuthenticator implements AuthenticatorInterface
{
    public function authenticate()
    {
        throw new \Tymon\JWTAuth\Exceptions\JWTException;
    }
}

class ExpiredAuthenticator implements AuthenticatorInterface
{
    public function authenticate()
    {
        throw new \Tymon\JWTAuth\Exceptions\TokenExpiredException;
    }
}

class ValidAuthenticator implements AuthenticatorInterface
{
    public function authenticate()
    {
    }
}
