<?php

declare(strict_types=1);

namespace Directus\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelationRequest extends FormRequest
{
    /**
     * @var array<string>
     */
    private $fieldRules = [
        // TODO: rules
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = $this->fieldRules;

        if ($this->method() === 'PATCH') {
            // TODO: change rules for updates
        }

        return $rules;
    }

    public function messages(): array
    {
        return [];
    }
}
