<?php

declare(strict_types=1);

namespace Directus\Requests;

use Directus\Database\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserInviteRequest extends FormRequest
{
    /**
     * @var array<string>
     */
    private $fieldRules = [
        'email' => 'required|email|unique:'.User::class.',email',
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
