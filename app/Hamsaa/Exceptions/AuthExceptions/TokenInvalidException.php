<?php

namespace App\Hamsaa\Exceptions\AuthExceptions;

use App\Hamsaa\Constants\SystemResponses;
use App\Hamsaa\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\Response as IlluminateResponse;

class TokenInvalidException extends BaseException
{
    protected $message = SystemResponses::TOKEN_INVALID;
    protected $statusCode = IlluminateResponse::HTTP_UNAUTHORIZED;
}
