<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * Activity controller.
 */
class ActivityController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query {
                    activities {
                        id
                        action
                        action_by
                        action_on
                        ip
                        user_agent
                        collection_id
                        item
                        edited_on
                        comment
                        comment_deleted_on
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
                query Activity($id: String!) {
                    activity(id: $id) {
                        id
                        action
                        action_by
                        action_on
                        ip
                        user_agent
                        collection_id
                        item
                        edited_on
                        comment
                        comment_deleted_on
                    }
                }
            ', $fields)
        );
    }

    public function createComment(): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = array_merge(request()->all(), [
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // TODO: query fields

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                mutation CreateActivityComment(
                    $collection: String!,
                    $item: String!,
                    $comment: String!,
                    $ip: String,
                    $user_agent: String
                ) {
                    createActivityComment(
                        collection_id: $collection,
                        item: $item,
                        comment: $comment,
                        ip: $ip,
                        user_agent: $user_agent
                    ) {
                        id
                        action
                        action_by
                        action_on
                        ip
                        user_agent
                        collection_id
                        item
                        edited_on
                        comment
                        comment_deleted_on
                    }
                }
            ', $fields)
        );
    }

    public function updateComment(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = array_merge(request()->all(), [
            'id' => $key,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                mutation UpdateActivityComment(
                    $id: String!,
                    $comment: String!,
                    $ip: String,
                    $user_agent: String
                ) {
                    updateActivityComment(
                        id: $id,
                        comment: $comment,
                        ip: $ip,
                        user_agent: $user_agent
                    ) {
                        id
                        action
                        action_by
                        action_on
                        ip
                        user_agent
                        collection_id
                        item
                        edited_on
                        comment
                        comment_deleted_on
                    }
                }
            ', $fields)
        );
    }

    public function deleteComment(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = [
            'id' => $key,
            'comment_deleted_on' => Carbon::now(),
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                mutation DeleteActivityComment(
                    id: String!,
                    $comment_deleted_on: DateTime
                ) {
                    deleteActivityComment(
                        id: $id,
                        comment_deleted_on: $comment_deleted_on
                    ) {
                        id
                    }
                }
            ', $fields)
        );
    }
}
