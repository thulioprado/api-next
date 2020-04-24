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
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->revisions()->all()
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->revisions()->find($key)
        );
    }
}
