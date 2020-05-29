<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Collection controller.
 */
class CollectionController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query {
                    collections {
                        id
                        name
                        hidden
                        single
                        system
                        icon
                        note
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
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query Collection($id: String!) {
                    collection(id: $id) {
                        id
                        name
                        hidden
                        single
                        system
                        icon
                        note
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
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                mutation CreateCollection(
                    $name: String!,
                    $fields: Json!,
                    $hidden: Boolean,
                    $single: Boolean,
                    $system: Boolean,
                    $icon: String,
                    $note: String,
                    $translation: [String]
                ) {
                    createCollection(
                        name: $name,
                        fields: $fields,
                        hidden: $hidden,
                        single: $single,
                        system: $system,
                        icon: $icon,
                        note: $note,
                        translation: $translation
                    ) {
                        id
                        name
                        hidden
                        single
                        system
                        icon
                        note
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
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                mutation UpdateCollection(
                    $id: String!,
                    $name: String,
                    $fields: Json,
                    $hidden: Boolean,
                    $single: Boolean,
                    $system: Boolean,
                    $icon: String,
                    $note: String,
                    $translation: [String]
                ) {
                    updateCollection(
                        name: $name,
                        fields: $fields,
                        hidden: $hidden,
                        single: $single,
                        system: $system,
                        icon: $icon,
                        note: $note,
                        translation: $translation
                    ) {
                        id
                        name
                        hidden
                        single
                        system
                        icon
                        note
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
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                mutation DeleteCollection($id: String!) {
                    deleteCollection(id: $id) {
                        id
                    }
                }
            ', $fields)
        );
    }
}
