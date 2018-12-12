<?php

namespace App\Http\Requests;

use App\Hamsaa\Exceptions\ExceptionFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }


    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            throw ExceptionFactory::fromErrorMessage($validator->errors());
        }
    }
}
