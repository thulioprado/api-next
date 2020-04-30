<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\Models\Revision;
use Directus\Exceptions\RevisionNotFound;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Revision controller.
 */
class RevisionController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Collection $revisions */
        $revisions = Revision::with(['activity', 'collection', 'parentCollection'])->get();

        return directus()->respond()->with($revisions->toArray());
    }

    /**
     * @throws RevisionNotFound
     */
    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Revision $revision */
        $revision = Revision::with(['activity', 'collection', 'parentCollection'])->findOrFail($key);

        return directus()->respond()->with($revision->toArray());
    }
}
