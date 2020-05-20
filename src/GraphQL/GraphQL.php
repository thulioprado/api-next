<?php

declare(strict_types=1);

namespace Directus\GraphQL;

use Directus\GraphQL\Server\Executor as ServerExecutor;

class GraphQL
{
    /**
     * Gets the server graph executor.
     */
    public function server(): ServerExecutor
    {
        return new ServerExecutor();
    }

    /**
     * Gets a project graph executor.
     */
    public function project(string $project): Executor
    {
        return new ServerExecutor();
    }
}
