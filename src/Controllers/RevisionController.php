<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Revision controller.
 */
class RevisionController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query {
                    revisions {
                        id
                        activity_id
                        collection_id
                        item
                        data
                        delta
                        parent_collection_id
                        parent_item
                        parent_changed
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
                query Revisions($id: String!) {
                    revision(id: $id) {
                        id
                        activity_id
                        collection_id
                        item
                        data
                        delta
                        parent_collection_id
                        parent_item
                        parent_changed
                    }
                }
            ', $fields)
        );
    }
}
