<?php

namespace Tests\Unit;

use App\Hamsaa\Exceptions\BaseException;
use Tests\TestCase;

class BaseExceptionTest extends TestCase
{
    /** @test */
    public function does_it_get_system_message_properly()
    {
        $this->assertEquals('ERROR', (new TestException())->getMessage());
    }

    /** @test */
    public function does_it_get_status_code_properly()
    {
        $this->assertEquals(101, (new TestException())->getStatusCode());
    }
}

class TestException extends BaseException
{
    protected $message = 'ERROR';
    protected $statusCode = 101;
}
