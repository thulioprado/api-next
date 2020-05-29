<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project;

use Directus\GraphQL\Engine;
use Directus\GraphQL\Events\EnhanceProjectSchema;

class Project extends Engine
{
    protected function file(): string
    {
        return __DIR__.'/Schema/Schema.graphql';
    }

    protected function transform(string $source): string
    {
        /** @var array<string> $additional */
        $sources = event(new EnhanceProjectSchema($source));
        array_unshift($sources, $source);
        return implode('\n', $sources);
    }
}
