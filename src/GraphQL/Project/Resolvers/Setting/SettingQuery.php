<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project\Resolvers\Setting;

use Directus\Database\Models\Setting;
use Illuminate\Support\Arr;

trait SettingQuery
{
    /**
     * Resolves the settings field.
     *
     * @return mixed
     */
    public static function resolveSettings()
    {
        return Setting::all();
    }

    /**
     * Resolves the setting field.
     *
     * @param mixed $root
     */
    public static function resolveSetting($root, array $arguments): array
    {
        return Setting::findOrFail(Arr::get($arguments, 'key'))->toArray();
    }
}
