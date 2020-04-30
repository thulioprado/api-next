<?php

declare(strict_types=1);

namespace Directus\Requests;

use Directus\Database\Models\Role;
use Directus\Database\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * @var array<string>
     */
    private $fieldRules = [
        'status' => 'required|string',
        'role_id' => 'required|exists:'.Role::class.',id',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email|unique:'.User::class.',email',
        'password' => 'required|string',
        'last_access_on' => 'date|nullable',
        'last_page' => 'string|nullable',
        //'external_id' => 'string|nullable',
        'theme' => 'string|nullable',
        '2fa_secret' => 'string|nullable',
        'password_reset_token' => 'string|nullable',
        'timezone' => 'string|nullable',
        'locale' => 'string|nullable',
        'locale_options' => 'string|nullable',
        //'avatar_id' => 'string|nullable',
        'company' => 'string|nullable',
        'title' => 'string|nullable',
        'email_notifications' => 'boolean|nullable',
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

            $rules['status'] = 'string';
            $rules['role_id'] = 'exists:'.Role::class.',id';
            $rules['first_name'] = 'string';
            $rules['last_name'] = 'string';
            $rules['email'] = 'email|unique:'.User::class.',email,'.$key;
            $rules['password'] = 'string';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [];
    }
}
