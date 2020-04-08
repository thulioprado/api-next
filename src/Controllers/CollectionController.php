<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Contracts\Database\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Collection controller.
 */
class CollectionController extends BaseController
{
    /**
     * Gets all resources on specified collection.
     */
    public function index(Collection $collection): JsonResponse
    {
        return response()->json($collection->builder()->get());
    }

    /**
     * Gets specific resource on specified collection.
     */
    public function show(Collection $collection, string $id): JsonResponse
    {
        return response()->json($collection->builder()->find($id));
    }
}
