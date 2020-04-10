<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\System\Models\Setting;
use Directus\Exceptions\SettingAlreadyExists;
use Directus\Exceptions\SettingNotFound;
use Directus\Services\Settings\SettingsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Setting controller.
 */
class SettingsController extends BaseController
{
    public function all(SettingsService $settings): JsonResponse
    {
        // TODO: validate parameters
        // TODO: implement limit, offset, page, single, meta parameters

        return directus()->respond()->with(
            $settings->all()
        );
    }

    /**
     * @throws SettingNotFound
     */
    public function one(SettingsService $settings, string $key): JsonResponse
    {
        // TODO: validate parameters

        return directus()->respond()->with(
            $settings->entry($key)->toArray()
        );
    }

    /**
     * @throws SettingAlreadyExists
     */
    public function create(SettingsService $settings, Request $request): JsonResponse
    {
        // TODO: validate parameters

        /** @var string $key */
        $key = $request->post('key');
        $value = $request->post('value');

        return directus()->respond()->with(
            $settings->create($key, $value)
        );
    }

    /**
     * @throws SettingNotFound
     */
    public function update(SettingsService $settings, Request $request, string $key): JsonResponse
    {
        // TODO: validate parameter

        return directus()->respond()->with(
            $settings->update($key, $request->post('value'))
        );
    }

    /**
     * @throws SettingNotFound
     * @throws Exception
     */
    public function delete(SettingsService $settings, string $key): JsonResponse
    {
        // TODO: validate parameter
        $settings->delete($key);

        return directus()->respond()->withNothing();
    }
}
