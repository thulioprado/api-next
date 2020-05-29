<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server\Resolvers;

use Directus\Contracts\GraphQL\Resolver;
use Directus\GraphQL\Resolvers\Traits\StaticResolver;
use Illuminate\Support\Str;

class ProjectResolver
{
    /**
     * Resolves the ping field.
     */
    public static function resolveName(array $project): string
    {
        return $project['name'] ?? Str::title($project['id']);
    }
}
