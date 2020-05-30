<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Webhook controller.
 */
class WebhookController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query {
                    webhooks {
                        id
                        status
                        http_action
                        url
                        collection_id
                        directus_action
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
                query Webhook($id: String!) {
                    webhook(id: $id) {
                        id
                        status
                        http_action
                        url
                        collection_id
                        directus_action
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
                mutation CreateWebhook(
                    $status: String,
                    $http_action: String,
                    $url: String,
                    $collection_id: String,
                    $directus_actionstatus: String
                ) {
                    createWebhook(
                        status: $status,
                        http_action: $http_action,
                        url: $url,
                        collection_id: $collection_id,
                        directus_actionstatus: $directus_actionstatus
                    ) {
                        id
                        status
                        http_action
                        url
                        collection_id
                        directus_action
                    }
                }
            ', $fields)
        );
    }

    public function update(string $key): JsonResponse
    {
        // TODO: query fields

        $project = config('directus.project.id', 'api');
        $fields = array_merge(request()->all(), [
            'id' => $key,
        ]);

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
            mutation UpdateWebhook(
                $id: String!,
                $status: String,
                $http_action: String,
                $url: String,
                $collection_id: String,
                $directus_actionstatus: String
            ) {
                updateWebhook(
                    id: $id,
                    status: $status,
                    http_action: $http_action,
                    url: $url,
                    collection_id: $collection_id,
                    directus_actionstatus: $directus_actionstatus
                ) {
                    id
                    status
                    http_action
                    url
                    collection_id
                    directus_action
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
                mutation DeleteWebhook($id: String!) {
                    deleteWebhook(id: $id) {
                        id
                    }
                }
            ', $fields)
        );
    }

    public function revisions(string $key, string $offset = null): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [
            'item' => $key,
            'offset' => $offset,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query Revisions($item: String!, $offset: Int) {
                    revisions(item: $item, offset: $offset) {
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
