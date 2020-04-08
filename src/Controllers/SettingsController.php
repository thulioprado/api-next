<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\System\Models\Settings;
use Directus\Exceptions\SettingAlreadyExists;
use Directus\Exceptions\SettingNotFound;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Server controller.
 */
class SettingsController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate parameters
        // TODO: limit, offset, page, single, meta parameters

        return directus()->respond()->with(
            Settings::all()
        );
    }

    /**
     * @throws SettingNotFound
     */
    public function one(string $key): JsonResponse
    {
        // TODO: validate parameters
        return directus()->respond()->with(
            $this->findSettingOrFail($key)
        );
    }

    /**
     * @throws SettingAlreadyExists
     */
    public function create(Request $request): JsonResponse
    {
        // TODO: validate parameters
        $validated = $request->validate([
            'key' => 'required|string',
            'value' => 'required',
        ]);

        $setting = new Settings();
        $setting->key = $validated['key'];
        $setting->value = $validated['value'];

        try {
            $setting->save();
        } catch (QueryException $err) {
            throw new SettingAlreadyExists($setting->key);
        }

        return directus()->respond()->with($setting->toArray());
    }

    /**
     * @throws SettingNotFound
     */
    public function update(Request $request, string $key): JsonResponse
    {
        $setting = $this->findSettingOrFail($key);
        $setting->value = $request->post('value');
        $setting->save();

        return directus()->respond()->with($setting->toArray());
    }

    /**
     * @throws SettingNotFound
     * @throws Exception
     */
    public function delete(string $key): JsonResponse
    {
        $setting = $this->findSettingOrFail($key);
        $setting->delete();

        return directus()->respond()->withNothing();
    }

    /**
     * @throws SettingNotFound
     */
    private function findSettingOrFail(string $key): Settings
    {
        $setting = Settings::where('key', '=', $key)->first();
        if ($setting === null) {
            throw new SettingNotFound($key);
        }

        return $setting;
    }
}
