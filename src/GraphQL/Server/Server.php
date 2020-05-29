<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server;

use Directus\GraphQL\Engine;
use Directus\GraphQL\Events\EnhanceServerSchema;
use Directus\GraphQL\Server\Resolvers\ProjectResolver;
use Directus\GraphQL\Server\Resolvers\QueryResolver;
use Illuminate\Support\Str;

class Server extends Engine
{
    private static $resolvers = [
        'Query' => QueryResolver::class,
        'Project' => ProjectResolver::class,
    ];

    protected function file(): string
    {
        return __DIR__ . '/Schema/Schema.graphql';
    }

    protected function transform(string $source): string
    {
        /** @var array<string> $additional */
        $sources = event(new EnhanceServerSchema($source));
        array_unshift($sources, $source);
        return implode('\n', $sources);
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
