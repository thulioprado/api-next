<?php

declare(strict_types=1);

namespace Directus\GraphQL;

use Directus\GraphQL\Types\QueryType;
use GraphQL\Error\Debug;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

class Runner
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

    /**
     * @return mixed
     */
    public function execute(string $query, ?array $variables = [])
    {
        $result = GraphQL::executeQuery(
            new Schema([
                'query' => new QueryType(),
            ]),
            $query,
            null,
            $this->context ?? [],
            $variables ?? []
        );

        return $result->toArray(
            Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE,
        );
    }
}
