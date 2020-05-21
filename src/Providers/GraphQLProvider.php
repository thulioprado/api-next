<?php

declare(strict_types=1);

namespace Directus\Providers;

use Directus\GraphQL\GraphQL;
use Illuminate\Support\ServiceProvider;
use Webmozart\PathUtil\Path;

/**
 * GraphQL provider.
 */
class GraphQLProvider extends ServiceProvider
{
    /**
     * Service register.
     */
    public function register(): void
    {
        $this->app->bind(GraphQL::class, GraphQL::class);

        $this->publishes([
            __DIR__.'/../../public/graphiql' => public_path(
                Path::join(config('directus.routes.base'), 'graphiql')
            ),
        ], [
            'directus-graphiql',
        ]);
    }
}
