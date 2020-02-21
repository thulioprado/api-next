<?php

declare(strict_types=1);

namespace Directus\Laravel\Controllers;

use Directus\Framework\Contracts\Collections\Collection;
use Directus\Framework\Contracts\Projects\Project;
use Illuminate\Http\JsonResponse;

/**
 * Server controller.
 */
class ProjectController extends Controller
{
    /**
     * Gets all resources on specified collection.
     */
    public function index(Project $project, Collection $collection): JsonResponse
    {
        return response()->json($collection->items()->get());
    }

    /**
     * Gets specific resource on specified collection.
     */
    public function show(Project $project, Collection $collection, string $id): JsonResponse
    {
        return response()->json($collection->items()->find($id));
    }
}
