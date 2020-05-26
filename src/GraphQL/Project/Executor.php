<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project;

use Directus\GraphQL\Context;
use Directus\GraphQL\Project\Types\QueryType;
use Directus\GraphQL\Types\Types;
use GraphQL\Executor\ExecutionResult;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

class Executor
{
    /**
     * @var mixed
     */
    protected $context;

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

    public function execute(string $query, ?array $variables = []): ExecutionResult
    {
        return GraphQL::executeQuery(
            new Schema([
                'query' => Types::from(QueryType::class),
            ]),
            $query,
            null,
            $this->context ?? [],
            $variables ?? []
        );
    }
}
