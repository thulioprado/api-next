<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Folder controller.
 */
class FolderController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query {
                    folders {
                        id
                        name
                        parent_id
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
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query Folder($id: String!) {
                    folder(id: $id) {
                        id
                        name
                        parent_id
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
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                mutation CreateFolder($name: String!, $parent_id: String) {
                    createFolder(name: $name, parent_id: $parent_id) {
                        id
                        name
                        parent_id
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
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                mutation UpdateFolder($id: String!, $name: String, $parent_id: String) {
                    updateFolder(id: $id, name: $name, parent_id: $parent_id) {
                        id
                        name
                        parent_id
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
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                mutation DeleteFolder($id: String!) {
                    deleteFolder(id: $id) {
                        id
                    }
                }
            ', $fields)
        );
    }
}
