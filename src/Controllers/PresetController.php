<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Preset controller.
 */
class PresetController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                query {
                    presets {
                        id
                        title
                        collection_id
                        user_id
                        role_id
                        search_query
                        filters
                        view_type
                        view_query
                        view_options
                        translation
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
            'id' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                query Preset($id: String!) {
                    preset(id: $id) {
                        id
                        title
                        collection_id
                        user_id
                        role_id
                        search_query
                        filters
                        view_type
                        view_query
                        view_options
                        translation
                    }
                }
            ', $fields)
        );
    }

    public function create(): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = request()->all();

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation CreatePreset(
                    $collection_id: String!,
                    $user_id: String,
                    $role_id: String,
                    $title: String,
                    $search_query: String,
                    $filters: [String],
                    $view_type: String,
                    $view_query: String,
                    $view_options: [String],
                    $translation: [String]
                ) {
                    createPreset(
                        collection_id: $collection_id,
                        user_id: $user_id,
                        role_id: $role_id,
                        title: $title,
                        search_query: $search_query,
                        filters: $filters,
                        view_type: $view_type,
                        view_query: $view_query,
                        view_options: $view_options,
                        translation: $translation
                    ) {
                        id
                        title
                        collection_id
                        user_id
                        role_id
                        search_query
                        filters
                        view_type
                        view_query
                        view_options
                        translation
                    }
                }
            ', $fields)
        );
    }

    public function update(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = array_merge(request()->all(), [
            'id' => $key,
        ]);

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation UpdatePreset(
                    $id: String!,
                    $collection_id: String,
                    $user_id: String,
                    $role_id: String,
                    $title: String,
                    $search_query: String,
                    $filters: [String],
                    $view_type: String,
                    $view_query: String,
                    $view_options: [String],
                    $translation: [String]
                ) {
                    updatePreset(
                        id: $id,
                        collection_id: $collection_id,
                        user_id: $user_id,
                        role_id: $role_id,
                        title: $title,
                        search_query: $search_query,
                        filters: $filters,
                        view_type: $view_type,
                        view_query: $view_query,
                        view_options: $view_options,
                        translation: $translation
                    ) {
                        id
                        title
                        collection_id
                        user_id
                        role_id
                        search_query
                        filters
                        view_type
                        view_query
                        view_options
                        translation
                    }
                }
            ', $fields)
        );
    }

    public function delete(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = [
            'id' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation DeletePreset($id: String!) {
                    deletePreset(id: $id) {
                        id
                    }
                }
            ', $fields)
        );
    }
}
