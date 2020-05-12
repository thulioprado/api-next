<?php

declare(strict_types=1);

namespace Directus\Requests;

use Directus\Database\Models\Setting;

class SettingCreateRequest extends DirectusRequest
{
    public function rules(): array
    {
        // TODO: make a validation for value?
        return [
            'key' => 'required|string|unique:'.Setting::class.',key',
        ];
    }
}
