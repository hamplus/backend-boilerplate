<?php

namespace Tests\Unit;

use App\Hamsaa\Exceptions\AuthExceptions\TokenInvalidException;
use Tests\TestCase;

class TokenInvalidExceptionTest extends TestCase
{
    /** @test */
    public function does_it_get_system_message_properly()
    {
        $this->assertEquals('TOKEN_INVALID', (new TokenInvalidException())->getMessage());
    }

    /** @test */
    public function does_it_get_status_code_properly()
    {
        $this->assertEquals(401, (new TokenInvalidException())->getStatusCode());
    }
}
