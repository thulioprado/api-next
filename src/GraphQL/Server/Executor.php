<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server;

use Directus\GraphQL\Context;
use Directus\GraphQL\Types\QueryType;
use Directus\GraphQL\Types\Types;
use GraphQL\Error\Debug;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

class Executor
{
    /**
     * @var mixed
     */
    protected $context;

    /**
     * @var bool
     */
    protected $debug;

    /**
     * Runner constructor.
     */
    public function __construct()
    {
        $this->context = new Context();
        $this->debug = (bool) config('app.debug');
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
                'query' => Types::from(Query::class),
            ]),
            $query,
            null,
            $this->context ?? [],
            $variables ?? []
        );

        return $result->toArray(
            $this->debug ? Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE : false
        );
    }
}
