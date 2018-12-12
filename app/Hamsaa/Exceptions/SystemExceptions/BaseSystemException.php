<?php

namespace App\Hamsaa\Exceptions\SystemExceptions;

use App\Hamsaa\Exceptions\BaseException;

abstract class BaseSystemException extends BaseException
{
    protected $statusCode = 500;
    protected $title = '';

    /**
     * @return int
     */
    public function getTitle(): int
    {
        return $this->title;
    }
}
