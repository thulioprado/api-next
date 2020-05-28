<?php

declare(strict_types=1);

namespace Directus\GraphQL;

use Directus\GraphQL\Project\Project;
use Directus\GraphQL\Server\Server;

class GraphQL
{
    /**
     * Gets the server graph executor.
     */
    public function server(): Server
    {
        return app()->make(Server::class);
    }

    /**
     * Gets a project graph executor.
     */
    public function project(string $project): Project
    {
        return app()->make(Project::class, [
            'project' => $project,
        ]);
    }
}
