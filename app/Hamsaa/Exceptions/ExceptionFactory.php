<?php

namespace App\Hamsaa\Exceptions;

use App\Hamsaa\Exceptions\ValidationExceptions\ValidationException;
use Illuminate\Support\MessageBag;

class ExceptionFactory
{
    public static function fromErrorMessage(MessageBag $error): BaseException
    {
        //Explode is for cases that array items not valid
        $errorField = explode('.', strtoupper($error->keys()[0]))[0];

        if (strpos($error->first(), 'required') || strpos($error->first(), 'present')) {
            return (new ValidationException)->setMessage($errorField . '_NOT_PROVIDED');
        }

        return (new ValidationException)->setMessage($errorField . '_NOT_VALID');
    }
}
