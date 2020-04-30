<?php

declare(strict_types=1);

namespace Directus\Requests;

use Directus\Database\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * @var array<string>
     */
    private $fieldRules = [
        'name' => 'required|string|unique:'.Role::class.',name',
        'description' => 'string|nullable',
        'ip_whitelist' => 'array|nullable',
        //'external_id' => 'string|nullable',
        'module_listing' => 'array|nullable',
        'collection_listing' => 'array|nullable',
        'enforce_2fa' => 'boolean|nullable',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = $this->fieldRules;

        if ($this->method() === 'PATCH') {
            $key = $this->route('key');
            $rules['name'] = 'string|unique:'.Role::class.',name,'.$key;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [];
    }
}
