<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project;

use Directus\GraphQL\Engine;
use Directus\GraphQL\Events\EnhanceProjectSchema;
use Directus\GraphQL\Project\Resolvers\MutationResolver;
use Directus\GraphQL\Project\Resolvers\QueryResolver;
use Directus\GraphQL\Types\Scalars\JsonType;
use Illuminate\Support\Str;

class Project extends Engine
{
    private static $resolvers = [
        'Query' => QueryResolver::class,
        'Mutation' => MutationResolver::class,
    ];

    private static $scalars = [
        'Json' => JsonType::class,
    ];

    protected function file(): string
    {
        return dirname(__DIR__, 3).'/graphql/Project.graphql';
    }

    protected function transform(string $source): string
    {
        /** @var array<string> $additional */
        $sources = event(new EnhanceProjectSchema($source));
        array_unshift($sources, $source);

        return implode('\n', $sources);
    }

    protected function scalar(string $type): ?string
    {
        return static::$scalars[$type] ?? null;
    }

    protected function resolve(string $type, string $field): ?callable
    {
        if (!isset(static::$resolvers[$type])) {
            return null;
        }

        $class = static::$resolvers[$type];
        $method = 'resolve'.Str::studly($field);
        if (method_exists($class, $method)) {
            return [$class, $method];
        }

        return null;
    }
}
