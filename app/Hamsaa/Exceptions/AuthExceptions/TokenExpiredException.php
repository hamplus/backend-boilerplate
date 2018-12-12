<?php

namespace App\Hamsaa\Exceptions\AuthExceptions;

use App\Hamsaa\Constants\SystemResponses;
use App\Hamsaa\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\Response as IlluminateResponse;

class TokenExpiredException extends BaseException
{
    protected $message = SystemResponses::TOKEN_EXPIRED;
    protected $statusCode = IlluminateResponse::HTTP_UNAUTHORIZED;
}
