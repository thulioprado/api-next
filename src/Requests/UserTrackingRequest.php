<?php

declare(strict_types=1);

namespace Directus\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTrackingRequest extends FormRequest
{
    /**
     * @var array<string>
     */
    private $fieldRules = [
        'last_page' => 'required|string',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->fieldRules;
    }

    public function messages(): array
    {
        return [];
    }
}
