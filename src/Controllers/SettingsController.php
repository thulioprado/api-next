<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\Models\Setting;
use Directus\Exceptions\SettingNotCreated;
use Directus\Exceptions\SettingNotFound;
use Directus\Requests\SettingCreateRequest;
use Directus\Requests\SettingUpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Setting controller.
 */
class SettingsController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate parameters
        // TODO: implement limit, offset, page, single, meta parameters

        /** @var Collection $settings */
        $settings = Setting::all();

        return directus()->respond()->with($settings->toArray());
    }

    /**
     * @throws SettingNotFound
     */
    public function fetch(string $key): JsonResponse
    {
        // TODO: validate parameters

        /** @var Setting $settings */
        $settings = Setting::findOrFail($key);

        return directus()->respond()->with($settings->toArray());
    }

    /**
     * @throws SettingNotCreated
     */
    public function create(SettingCreateRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $settings = directus()->databases()->system()->transaction(function () use ($attributes): Setting {
            /** @var Setting $settings */
            $settings = new Setting($attributes);
            $settings->saveOrFail();

            return $settings;
        });

        return directus()->respond()->with($settings->toArray());
    }

    /**
     * @throws SettingNotFound
     */
    public function update(SettingUpdateRequest $request, string $key): JsonResponse
    {
        /** @var Setting $settings */
        $settings = Setting::findOrFail($key);
        $settings->update($request->all());

        return directus()->respond()->with($settings->toArray());
    }

    /**
     * @throws SettingNotFound
     */
    public function delete(string $key): JsonResponse
    {
        /** @var Setting $settings */
        $settings = Setting::findOrFail($key);
        $settings->delete();

        return directus()->respond()->withNothing();
    }
}
