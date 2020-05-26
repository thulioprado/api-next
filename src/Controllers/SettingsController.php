<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Setting controller.
 */
class SettingsController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                query {
                    settings {
                        key
                        value
                    }
                }
            ', $fields)
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [
            'key' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                query Setting($key: String!) {
                    setting(key: $key) {
                        key
                        value
                    }
                }
            ', $fields)
        );
    }

    public function create(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = request()->all();

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation CreateSetting($key: String!, $value: String) {
                    createSetting(key: $key, value: $value) {
                        key
                        value
                    }
                }
            ', $fields)
        );
    }

    public function update(string $key): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = array_merge(request()->all(), [
            'key' => $key,
        ]);

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                query UpdateSetting($key: String!, $value: String) {
                    updateSetting(key: $key, value: $value) {
                        key
                        value
                    }
                }
            ', $fields)
        );
    }

    public function delete(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = [
            'key' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation DeleteSetting($key: String!) {
                    deleteSetting(key: $key) {
                        key
                    }
                }
            ', $fields)
        );
    }

    /**
     * @throws NotImplemented
     */
    public function fields(string $key): JsonResponse
    {
        throw new NotImplemented();
    }
}
