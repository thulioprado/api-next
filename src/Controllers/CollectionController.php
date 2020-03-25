<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Contracts\Database\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Server controller.
 */
class CollectionController extends BaseController
{
    /**
     * Gets all resources on specified collection.
     */
    public function index(Collection $collection): JsonResponse
    {
        return response()->json($collection->query()->get());
    }

    /**
     * Gets specific resource on specified collection.
     */
    public function show(Collection $collection, string $id): JsonResponse
    {
        return response()->json($collection->query()->find($id));
    }
}
