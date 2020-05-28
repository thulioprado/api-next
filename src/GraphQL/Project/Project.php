<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project;

use Directus\Contracts\GraphQL\Engine;
use Directus\Contracts\GraphQL\Query\MutationBuilder as MutationBuilderContract;
use Directus\Contracts\GraphQL\Query\QueryBuilder as QueryBuilderContract;
use Directus\GraphQL\Context;
use Directus\GraphQL\Project\Types\MutationType;
use Directus\GraphQL\Project\Types\QueryType;
use Directus\GraphQL\Query\MutationBuilder;
use Directus\GraphQL\Query\QueryBuilder;
use Directus\GraphQL\Types\Types;
use GraphQL\Executor\ExecutionResult;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

class Project implements Engine
{
    /**
     * @var mixed
     */
    protected $context;

    /**
     * @var Schema
     */
    protected $schema;

    /**
     * @var MutationBuilder
     */
    protected $mutation;

    /**
     * @var QueryBuilder
     */
    protected $query;

    /**
     * Runner constructor.
     */
    public function __construct()
    {
        $this->context = new Context();
    }

    /**
     * Gets the context instance.
     */
    public function context(): Context
    {
        return $this->context;
    }

    /**
     * Gets the current schema.
     */
    public function schema(): Schema
    {
        return $this->schema ?? $this->schema = new Schema([
            'query' => Types::from(QueryType::class),
            'mutation' => Types::from(MutationType::class),
        ]);
    }

    /**
     * Gets a query builder.
     */
    public function query(): QueryBuilderContract
    {
        return $this->query ?? $this->query = new QueryBuilder($this);
    }

    /**
     * Gets a mutation builder.
     */
    public function mutation(string $name, ?string $alias = null): MutationBuilderContract
    {
        return new MutationBuilder($this, $name, $alias);
    }

    /**
     * Executes a query.
     */
    public function execute(string $query, ?array $variables = []): ExecutionResult
    {
        return GraphQL::executeQuery(
            $this->schema(),
            $query,
            null,
            $this->context ?? [],
            $variables ?? []
        );
    }
}
