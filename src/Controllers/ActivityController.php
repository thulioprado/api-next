<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\System\Models\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Activity controller.
 */
class ActivityController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->activities()->all()
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->activities()->find($key)
        );
    }

    public function createComment(): JsonResponse
    {
        $input = request()->validate([
            'collection' => 'required|string|exists:'.Collection::class.',name',
            'item' => 'required',
            'comment' => 'required|string',
        ]);

        return directus()->respond()->with(
            directus()->activities()->comment(
                data_get($input, 'comment'),
                data_get($input, 'collection'),
                data_get($input, 'item')
            )
        );
    }

    public function updateComment(string $key): JsonResponse
    {
        $input = request()->validate([
            'comment' => 'required|string',
        ]);

        return directus()->respond()->with(
            directus()->activities()->updateComment($key, data_get($input, 'comment'))
        );
    }

    public function deleteComment(string $key): JsonResponse
    {
        directus()->activities()->deleteComment($key);

        return directus()->respond()->withNothing();
    }
}
