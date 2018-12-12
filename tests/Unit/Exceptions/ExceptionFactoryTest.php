<?php

namespace Tests\Unit;

use App\Hamsaa\Constants\Regexes;
use App\Hamsaa\Exceptions\ExceptionFactory;
use Tests\TestCase;

class ExceptionFactoryTest extends TestCase
{
    /** @test */
    public function does_it_return_phone_not_provided_exception_with_the_right_message_bag()
    {
        $validator = \Validator::make([], [
            'phone' => 'required'
        ]);

        $exception = ExceptionFactory::fromErrorMessage($validator->errors());
        $this->assertEquals('PHONE_NOT_PROVIDED', $exception->getMessage());
    }

    /** @test */
    public function does_it_return_phone_not_valid_exception_with_the_right_message_bag()
    {
        $validator = \Validator::make(['phone' => '123456'], [
            'phone' => 'regex:/' . Regexes::PHONE_NUMBER . '/'
        ]);

        $exception = ExceptionFactory::fromErrorMessage($validator->errors());
        $this->assertEquals('PHONE_NOT_VALID', $exception->getMessage());
    }

    /** @test */
    public function does_it_return_code_not_provided_exception_with_the_right_message_bag()
    {
        $validator = \Validator::make([], [
            'code' => 'required'
        ]);

        $exception = ExceptionFactory::fromErrorMessage($validator->errors());
        $this->assertEquals('CODE_NOT_PROVIDED', $exception->getMessage());
    }

    /** @test */
    public function does_it_return_code_not_valid_exception_with_the_right_message_bag()
    {
        $validator = \Validator::make(['code' => 's'], [
            'code' => 'digits:' . config('hamsaa.verification.character_count')
        ]);

        $exception = ExceptionFactory::fromErrorMessage($validator->errors());
        $this->assertEquals('CODE_NOT_VALID', $exception->getMessage());
    }

    /** @test */
    public function does_it_return_text_not_provided_exception_with_the_right_message_bag()
    {
        $validator = \Validator::make([], [
            'text' => 'required'
        ]);

        $exception = ExceptionFactory::fromErrorMessage($validator->errors());
        $this->assertEquals('TEXT_NOT_PROVIDED', $exception->getMessage());
    }

    /** @test */
    public function does_it_return_text_not_valid_exception_with_the_right_message_bag()
    {
        $validator = \Validator::make(['text' => 1], [
            'text' => 'string'
        ]);

        $exception = ExceptionFactory::fromErrorMessage($validator->errors());
        $this->assertEquals('TEXT_NOT_VALID', $exception->getMessage());
    }

    /** @test */
    public function does_it_return_device_token_not_provided_exception_with_the_right_message_bag()
    {
        $validator = \Validator::make([], [
            'device_token' => 'required'
        ]);

        $exception = ExceptionFactory::fromErrorMessage($validator->errors());
        $this->assertEquals('DEVICE_TOKEN_NOT_PROVIDED', $exception->getMessage());
    }

    /** @test */
    public function does_it_return_device_token_not_valid_exception_with_the_right_message_bag()
    {
        $validator = \Validator::make(['device_token' => 1], [
            'device_token' => 'string'
        ]);

        $exception = ExceptionFactory::fromErrorMessage($validator->errors());
        $this->assertEquals('DEVICE_TOKEN_NOT_VALID', $exception->getMessage());
    }
}
