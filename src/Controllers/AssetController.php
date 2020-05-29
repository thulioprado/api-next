<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Asset controller.
 */
class AssetController extends BaseController
{
    public function fetch(string $key): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [
            'private_hash' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query Asset($private_hash: String!) {
                    asset(private_hash: $private_hash) {
                        id
                    }
                }
            ', $fields)
        );
    }
}
