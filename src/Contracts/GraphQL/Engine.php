<?php

declare(strict_types=1);

namespace Directus\Contracts\GraphQL;

use Directus\Contracts\GraphQL\Query\MutationBuilder;
use Directus\Contracts\GraphQL\Query\QueryBuilder;
use GraphQL\Executor\ExecutionResult;
use GraphQL\Type\Schema;

interface Engine
{
    /**
     * Gets the schema.
     */
    public function schema(): Schema;

    /**
     * Gets a query builder.
     */
    public function query(): QueryBuilder;

    /**
     * Gets a mutation builder.
     */
    public function mutation(string $name, ?string $alias = null): MutationBuilder;

    /**
     * Executes a query.
     */
    public function execute(string $query, ?array $variables = []): ExecutionResult;
}
