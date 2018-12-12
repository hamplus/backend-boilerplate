<?php

namespace Tests;

use Carbon\Carbon;

trait TestTokenTrait
{
    /** @test */
    public function does_api_respond_token_not_provided_if_the_token_is_missing()
    {
        $this->json(
            $this->method,
            $this->baseURL,
            [],
            []
        )->assertStatus(401)->assertJson(['message' => 'TOKEN_NOT_PROVIDED']);
    }

    /** @test */
    public function does_api_respond_token_not_valid_if_the_token_is_not_valid()
    {
        $this->json(
            $this->method,
            $this->baseURL,
            [],
            ['HTTP_Authorization' => 'Bearer something.wrong']
        )->assertStatus(401)->assertJson(['message' => 'TOKEN_INVALID']);
    }

    /** @test */
    public function does_api_respond_token_expired_if_the_token_is_expired()
    {
        Carbon::setTestNow(Carbon::now()->addMinutes(config('jwt.ttl') + 1));
        $this->json(
            $this->method,
            $this->baseURL,
            [],
            ['HTTP_Authorization' => 'Bearer ' . $this->token]
        )->assertStatus(401)->assertJson(['message' => 'TOKEN_EXPIRED']);
    }
}
