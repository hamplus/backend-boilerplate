<?php

namespace App\Hamsaa\Exceptions\ValidationExceptions;

use Symfony\Component\HttpFoundation\Response as IlluminateResponse;
use App\Hamsaa\Exceptions\BaseException;

/**
 * ValidationException class for all validation errors
 * with default 400 status code
 */
class ValidationException extends BaseException
{
    protected $statusCode = IlluminateResponse::HTTP_BAD_REQUEST;

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
