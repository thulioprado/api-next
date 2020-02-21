<?php

declare(strict_types=1);

namespace Directus\Laravel\Controllers;

use Directus\Framework\Contracts\Projects\Project;
use Directus\Framework\Directus;
use Directus\Laravel\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Server controller.
 */
class ServerController extends Controller
{
    /**
     * Server information.
     */
    public function info(): void
    {
        throw new NotImplemented();
    }

    /**
     * Server information.
     */
    public function projects(Directus $directus): JsonResponse
    {
        return Response::json([
            'data' => $directus->projects()
                ->all()
                ->filter(function (Project $project) {
                    return !$project->private();
                })
                ->map(function (Project $project) {
                    return $project->name();
                }),
            'public' => true,
        ]);
    }

    /**
     * Server ping.
     */
    public function ping(): string
    {
        return 'pong';
    }
}
