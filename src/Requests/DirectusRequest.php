<?php

declare(strict_types=1);

namespace Directus\Requests;

use Directus\Exceptions\RequestValidationFailed;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DirectusRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new RequestValidationFailed();
    }
}
