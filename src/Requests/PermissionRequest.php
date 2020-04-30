<?php

declare(strict_types=1);

namespace Directus\Requests;

use Directus\Database\Models\Collection;
use Directus\Database\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    /**
     * @var array<string>
     */
    private $fieldRules = [
        'collection_id' => 'required|exists:'.Collection::class.',id',
        'role_id' => 'required|exists:'.Role::class.',id',
        'status' => 'string|nullable',
        'create' => 'string|nullable',
        'read' => 'string|nullable',
        'update' => 'string|nullable',
        'delete' => 'string|nullable',
        'comment' => 'string|nullable',
        'explain' => 'string|nullable',
        'read_field_blacklist' => 'array|nullable',
        'write_field_blacklist' => 'array|nullable',
        'status_blacklist' => 'array|nullable',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = $this->fieldRules;

        if ($this->method() === 'PATCH') {
            $rules['collection_id'] = 'exists:'.Collection::class.',id';
            $rules['role_id'] = 'exists:'.Role::class.',id';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [];
    }
}
