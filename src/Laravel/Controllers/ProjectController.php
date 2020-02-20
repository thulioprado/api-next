<?php

declare(strict_types=1);

namespace Directus\Laravel\Controllers;

use Directus\Framework\Projects\Project;
use Illuminate\Http\JsonResponse;

/**
 * Server controller.
 */
class ProjectController extends Controller
{
    /**
     * Gets all resources on specified collection.
     */
    public function index(Project $project, string $collection): JsonResponse
    {
        return response()->json($project->collection($collection)->items()->get());
    }

    /**
     * Gets specific resource on specified collection.
     */
    public function show(Project $project, string $collection, string $id): JsonResponse
    {
        return response()->json($project->collection($collection)->items()->findOrFail($id));
    }
}
