<?php

namespace App\Hamsaa\Exceptions\AuthExceptions;

use App\Hamsaa\Constants\SystemResponses;
use App\Hamsaa\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\Response as IlluminateResponse;

class WrongCredentialsException extends BaseException
{
    protected $message = SystemResponses::WRONG_CREDENTIALS;
    protected $statusCode = IlluminateResponse::HTTP_UNAUTHORIZED;
}
