<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server;

use Directus\GraphQL\Engine;

class Server extends Engine
{
    protected function file(): string
    {
        return __DIR__.'/Schema.graphql';
    }
}
