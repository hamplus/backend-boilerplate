<?php

namespace Tests\Unit;

use App\Hamsaa\Exceptions\AuthExceptions\TokenNotProvidedException;
use Tests\TestCase;

class TokenProvidedExceptionTest extends TestCase
{
    /** @test */
    public function does_it_get_system_message_properly()
    {
        $this->assertEquals('TOKEN_NOT_PROVIDED', (new TokenNotProvidedException())->getMessage());
    }

    /** @test */
    public function does_it_get_status_code_properly()
    {
        $this->assertEquals(401, (new TokenNotProvidedException())->getStatusCode());
    }
}
