<?php

declare(strict_types=1);

namespace Directus\Services\Settings;

use Directus\Contracts\Services\Service;
use Directus\Database\System\Models\Setting;
use Directus\Exceptions\SettingAlreadyExists;
use Directus\Exceptions\SettingNotFound;
use Exception;
use Illuminate\Database\QueryException;

class SettingsService implements Service
{
    public function all(): array
    {
        return Setting::all()->toArray();
    }

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        try {
            return $this->entry($key)->value;
        } catch (SettingNotFound $err) {
            return $default;
        }
    }

    /**
     * @param mixed $value
     */
    public function set(string $key, $value): void
    {
        try {
            $setting = $this->entry($key);
            $setting->value = $value;
            $setting->save();
        } catch (SettingNotFound $err) {
            $this->create($key, $value);
        }
    }

    /**
     * @param mixed $value
     *
     * @throws SettingAlreadyExists
     */
    public function create(string $key, $value): array
    {
        $setting = new Setting();
        $setting->key = $key;
        $setting->value = $value;

        try {
            $setting->save();
        } catch (QueryException $err) {
            throw new SettingAlreadyExists($setting->key);
        }

        return $setting->toArray();
    }

    /**
     * @param mixed $value
     *
     * @throws SettingNotFound
     */
    public function update(string $key, $value): array
    {
        $setting = $this->entry($key);
        $setting->value = $value;
        $setting->save();

        return $setting->toArray();
    }

    /**
     * @throws SettingNotFound
     * @throws Exception
     */
    public function delete(string $key): void
    {
        $setting = $this->entry($key);
        $setting->delete();
    }

    /**
     * @throws SettingNotFound
     */
    public function entry(string $key): Setting
    {
        $setting = Setting::where('key', '=', $key)->first();
        if ($setting === null) {
            throw new SettingNotFound($key);
        }

        return $setting;
    }
}
