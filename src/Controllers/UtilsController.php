<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Utils controller.
 */
class UtilsController extends BaseController
{
    public function randomString(): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = request()->all();

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query randomString($length: Int) {
                    randomString(length: $length) {
                        random
                    }
                }
            ', $fields)
        );
    }

    public function hashCreate(): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = request()->all();

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query hashCreate($length: Int) {
                    hashCreate(length: $length) {
                        hash
                    }
                }
            ', $fields)
        );
    }

    public function hashMatch(): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = request()->all();

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query hashMatch($string: String!, $hash: String!) {
                    hashMatch(string: $string, hash: $hash) {
                        valid
                    }
                }
            ', $fields)
        );
    }

    public function generate2faSecret(): JsonResponse
    {
        $project = config('directus.project.id', 'api');

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query GenerateTFSecret($length: Int) {
                    generateTFSecret(length: $length) {
                        twofactor_secret
                    }
                }
            ')
        );
    }
}
