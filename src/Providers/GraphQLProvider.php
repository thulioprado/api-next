<?php

declare(strict_types=1);

namespace Directus\Providers;

use Directus\Directus;
use Directus\GraphQL\Runner;
use Illuminate\Support\ServiceProvider;

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
    }
}
