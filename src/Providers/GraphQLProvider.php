<?php

declare(strict_types=1);

namespace Directus\Providers;

use Directus\Directus;
use Directus\GraphQL\Runner;
use Illuminate\Support\ServiceProvider;
use Webmozart\PathUtil\Path;

/**
 * GraphQL provider.
 */
class GraphQLProvider extends ServiceProvider
{
    /**
     * Service register.
     *
     * @noinspection StaticClosureCanBeUsedInspection
     */
    public function register(): void
    {
        Directus::macro('graphql', function (): Runner {
            return resolve(Runner::class);
        });

        $this->publishes([
            __DIR__.'/../../public/admin/graphiql' => public_path(
                Path::join(config('directus.routes.base'), 'graphiql')
            ),
        ], [
            'directus-graphiql',
        ]);
    }
}
