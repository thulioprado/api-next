<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Role controller.
 */
class RoleController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query {
                    roles {
                        id
                        name
                        description
                        ip_whitelist
                        external_id
                        module_listing
                        collection_listing
                        enforce_2fa
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
                query Role($id: String!) {
                    role(id: $id) {
                        id
                        name
                        description
                        ip_whitelist
                        external_id
                        module_listing
                        collection_listing
                        enforce_2fa
                    }
                }
            ', $fields)
        );
    }

    public function create(): JsonResponse
    {
        // TODO: query fields

        $project = config('directus.project.id', 'api');
        $fields = request()->all();

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                mutation CreateRole(
                    $name: String!,
                    $description: String,
                    $ip_whitelist: [String],
                    $external_id: String,
                    $module_listing: String,
                    $collection_listing: String,
                    $enforce_2fa: Boolean
                ) {
                    createRole(
                        name: $name,
                        description: $description,
                        ip_whitelist: $ip_whitelist,
                        external_id: $external_id,
                        module_listing: $module_listing,
                        collection_listing: $collection_listing,
                        enforce_2fa: $enforce_2fa
                    ) {
                        id
                        name
                        description
                        ip_whitelist
                        external_id
                        module_listing
                        collection_listing
                        enforce_2fa
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
                mutation UpdateRole(
                    $id: String!,
                    $name: String,
                    $description: String,
                    $ip_whitelist: [String],
                    $external_id: String,
                    $module_listing: String,
                    $collection_listing: String,
                    $enforce_2fa: Boolean
                ) {
                    updateRole(
                        id: $id,
                        name: $name,
                        description: $description,
                        ip_whitelist: $ip_whitelist,
                        external_id: $external_id,
                        module_listing: $module_listing,
                        collection_listing: $collection_listing,
                        enforce_2fa: $enforce_2fa
                    ) {
                        id
                        name
                        description
                        ip_whitelist
                        external_id
                        module_listing
                        collection_listing
                        enforce_2fa
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
                mutation DeleteRole($id: String!) {
                    deleteRole(id: $id) {
                        id
                    }
                }
            ', $fields)
        );
    }
}
