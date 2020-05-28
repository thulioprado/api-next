<?php

declare(strict_types=1);

namespace Directus\GraphQL;

use Directus\Contracts\GraphQL\Engine as EngineContract;
use Directus\Contracts\GraphQL\Query\MutationBuilder as MutationBuilderContract;
use Directus\Contracts\GraphQL\Query\QueryBuilder as QueryBuilderContract;
use Directus\GraphQL\Query\MutationBuilder;
use Directus\GraphQL\Query\QueryBuilder;
use GraphQL\Executor\ExecutionResult;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Utils\BuildSchema;
use GraphQL\Validator\Rules\DisableIntrospection;
use Illuminate\Contracts\Container\Container;

abstract class Engine implements EngineContract
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var mixed
     */
    protected $context;

    /**
     * @var Schema
     */
    protected $schema;

    /**
     * Runner constructor.
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Gets the context instance.
     */
    public function context(): Context
    {
        return $this->container->make(Context::class);
    }

    /**
     * Gets a query builder.
     */
    public function query(): QueryBuilderContract
    {
        return new QueryBuilder($this);
    }

    /**
     * Gets a mutation builder.
     */
    public function mutation(string $name, ?string $alias = null): MutationBuilderContract
    {
        return new MutationBuilder($this, $name, $alias);
    }

    /**
     * Gets the schema.
     */
    public function schema(): Schema
    {
        $schema = BuildSchema::build(
            file_get_contents($this->file()),
            static function ($config, $definition) {
                return $config;
            }
        );

        return $schema;
    }

    /**
     * Executes a query.
     */
    public function execute(string $query, ?array $variables = []): ExecutionResult
    {
        $rules = null;
        if (config('app.debug')) {
            $rules = [
                new DisableIntrospection(),
            ];
        }

        return GraphQL::executeQuery(
            $this->schema(),
            $query,
            null,
            $this->context ?? [],
            $variables ?? [],
            null,
            null,
            $rules
        );
    }

    /**
     * The location if type language file.
     */
    abstract protected function file(): string;
}
