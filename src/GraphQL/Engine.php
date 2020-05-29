<?php

declare(strict_types=1);

namespace Directus\GraphQL;

use Directus\Contracts\GraphQL\Engine as EngineContract;
use Directus\Contracts\GraphQL\Query\MutationBuilder as MutationBuilderContract;
use Directus\Contracts\GraphQL\Query\QueryBuilder as QueryBuilderContract;
use Directus\Contracts\GraphQL\Resolver;
use Directus\GraphQL\Query\MutationBuilder;
use Directus\GraphQL\Query\QueryBuilder;
use Directus\GraphQL\Schema\Builder;
use Directus\GraphQL\Schema\Source;
use GraphQL\Executor\ExecutionResult;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Utils\BuildSchema;
use GraphQL\Validator\Rules\DisableIntrospection;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Webmozart\PathUtil\Path;

abstract class Engine implements EngineContract
{
    /**
     * @var Container
     */
    protected $container;

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
        if ($this->schema !== null) {
            return $this->schema;
        }

        $file = $this->file();

        $loader = new Source(Storage::createLocalDriver([
            'root' => Path::getDirectory($file),
        ]));

        $source = $loader->load(Path::getFilename($file), function ($source): string {
            return $this->transform($source);
        });

        return Builder::build($source,
            function(string $type, string $field): ?callable {
                return $this->resolve($type, $field);
            },
            function (string $name): ?string {
                return $this->scalar($name);
            }
        );
    }

    /**
     * Executes a query.
     */
    public function execute(string $query, ?array $variables = []): ExecutionResult
    {
        $rules = null;

        /** @var bool $debug */
        $debug = config('app.debug', false);
        if (!$debug) {
            $rules = [
                new DisableIntrospection(),
            ];
        }

        return GraphQL::executeQuery(
            $this->schema(),
            $query,
            null,
            $this->context(),
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

    /**
     * Gets a field resolver from type and name.
     */
    abstract protected function resolve(string $type, string $field): ?callable;

    /**
     * Gets a scalar type.
     */
    abstract protected function scalar(string $name): ?string;

    /**
     * Transforms the schema source.
     */
    abstract protected function transform(string $source): string;
}
