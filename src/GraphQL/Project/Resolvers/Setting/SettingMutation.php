<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project\Resolvers\Setting;

use Directus\Database\Models\Setting;
use Illuminate\Support\Arr;

trait SettingMutation
{
    /**
     * Resolves the createSetting field.
     *
     * @param mixed $root
     */
    public static function resolveCreateSetting($root, array $arguments): array
    {
        $setting = new Setting($arguments);
        $setting->saveOrFail();

        return $setting->toArray();
    }

    /**
     * Resolves the updateSetting field.
     *
     * @param mixed $root
     */
    public static function resolveUpdateSetting($root, array $arguments): array
    {
        $key = Arr::get($arguments, 'key');

        $setting = Setting::findOrFail($key);
        $setting->key = Arr::get($arguments, 'newKey') ?? $key;
        $setting->value = Arr::get($arguments, 'value');
        $setting->saveOrFail();

        return $setting->toArray();
    }

    /**
     * Resolves the deleteSetting field.
     *
     * @param mixed $root
     */
    public static function resolveDeleteSetting($root, array $arguments): array
    {
        $setting = Setting::findOrFail(Arr::get($arguments, 'key'));
        $setting->delete();

        return $setting->toArray();
    }
}
