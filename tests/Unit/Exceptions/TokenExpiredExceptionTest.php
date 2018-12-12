<?php

namespace Tests\Unit;

use App\Hamsaa\Exceptions\AuthExceptions\TokenExpiredException;
use Tests\TestCase;

class TokenExpiredExceptionTest extends TestCase
{
    /** @test */
    public function does_it_get_system_message_properly()
    {
        $this->assertEquals('TOKEN_EXPIRED', (new TokenExpiredException())->getMessage());
    }

    /** @test */
    public function does_it_get_status_code_properly()
    {
        $this->assertEquals(401, (new TokenExpiredException())->getStatusCode());
    }
}
