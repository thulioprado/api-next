<?php

declare(strict_types=1);

namespace Directus\Requests;

use Directus\Database\Models\Setting;

class SettingUpdateRequest extends DirectusRequest
{
    public function rules(): array
    {
        $key = $this->route('key');

        // TODO: make a validation for value?
        return [
            'key' => 'string|unique:'.Setting::class.',key,'.$key,
        ];
    }
}
