<?php

declare(strict_types=1);

namespace Directus\GraphQL;

use Directus\GraphQL\Query\QueryBuilder;
use Directus\GraphQL\Server\Server;

class GraphQL
{
    /**
     * Gets a new query builder.
     */
    public function queries(): QueryBuilder
    {
        return new QueryBuilder();
    }

    /**
     * Gets the server graph executor.
     */
    public function server(): Server
    {
        return new Server();
    }

    /**
     * Gets a project graph executor.
     */
    public function project(string $project): Server
    {
        return new Server();
    }
}
