<?php

namespace Tests\Unit;

use App\Hamsaa\Exceptions\AuthExceptions\WrongCredentialsException;
use Tests\TestCase;

class WrongCredentialsExceptionTest extends TestCase
{
    /** @test */
    public function does_it_get_system_message_properly()
    {
        $this->assertEquals('WRONG_CREDENTIALS', (new WrongCredentialsException())->getMessage());
    }

    /** @test */
    public function does_it_get_status_code_properly()
    {
        $this->assertEquals(401, (new WrongCredentialsException())->getStatusCode());
    }
}
