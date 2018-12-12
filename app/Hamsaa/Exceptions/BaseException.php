<?php

namespace App\Hamsaa\Exceptions;

use Exception;

abstract class BaseException extends Exception
{
    protected $statusCode = 500;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
