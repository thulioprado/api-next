<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\Models\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Preset controller.
 */
class PresetController extends BaseController
{
    public function all(): JsonResponse
    {
        return directus()->respond()->with(
            directus()->presets()->all()
        );
    }

    public function fetch(string $key): JsonResponse
    {
        return directus()->respond()->with(
            directus()->presets()->find($key)
        );
    }

    public function create(): JsonResponse
    {
        $input = request()->validate([
            'collection' => 'required|string|exists:'.Collection::class.',name',
            'title' => 'string|nullable',
            'user' => 'string|nullable',
            'role' => 'string|nullable',
            'search_query' => 'string|nullable',
            'filters' => 'array|nullable',
            'view_type' => 'string|nullable',
            'view_options' => 'array|nullable',
            'translation' => 'array|nullable',
        ]);

        return directus()->respond()->with(
            directus()->presets()->create($input['collection'], $input)
        );
    }

    public function update(string $key): JsonResponse
    {
        $input = request()->validate([
            'collection' => 'string|exists:'.Collection::class.',name',
            'title' => 'string|nullable',
            'user' => 'string|nullable',
            'role' => 'string|nullable',
            'search_query' => 'string|nullable',
            'filters' => 'array|nullable',
            'view_type' => 'string|nullable',
            'view_options' => 'array|nullable',
            'translation' => 'array|nullable',
        ]);

        return directus()->respond()->with(
            directus()->presets()->update($key, $input)
        );
    }

    public function delete(string $key): JsonResponse
    {
        directus()->presets()->delete($key);

        return directus()->respond()->withNothing();
    }
}
