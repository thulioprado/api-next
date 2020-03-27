<?php

declare(strict_types=1);

namespace Directus\Providers;

use Directus\Contracts\Database\Collection as CollectionContract;
use Directus\Contracts\Database\Database as DatabaseContract;
use Directus\Contracts\Database\System\Database as SystemDatabaseContract;
use Directus\Contracts\Database\System\Services\CollectionsService as CollectionsServiceContract;
use Directus\Contracts\Database\System\Services\FieldsService as FieldsServiceContract;
use Directus\Database\Collection;
use Directus\Database\Database;
use Directus\Database\System\Database as SystemDatabase;
use Directus\Database\System\Services\CollectionsService;
use Directus\Database\System\Services\FieldsService;
use Directus\Directus;
use Illuminate\Support\ServiceProvider;

/**
 * Config provider.
 */
class DependenciesProvider extends ServiceProvider
{
    /**
     * Service register.
     */
    public function register(): void
    {
        // Directus
        $this->app->bindIf(Directus::class, Directus::class);

        // Main database
        $this->app->bindIf(CollectionContract::class, Collection::class);

        $this->app->singletonIf(DatabaseContract::class, function (): DatabaseContract {
            /** @var string $connection */
            $connection = config('directus.databases.main.connection', 'default');
            if ($connection === 'default') {
                $connection = config('database.default', 'mysql');
            }

            return new Database($connection);
        });

        // System database
        $this->app->singletonIf(SystemDatabaseContract::class, function (): SystemDatabaseContract {
            /** @var string $connection */
            $connection = config('directus.databases.system.connection', 'default');
            if ($connection === 'default') {
                $connection = config('database.default', 'mysql');
            }

            return new SystemDatabase($connection, config('directus.databases.system.options.prefix', 'directus_'));
        });

        // System services
        $this->app->singletonIf(CollectionsServiceContract::class, CollectionsService::class);
        $this->app->singletonIf(FieldsServiceContract::class, FieldsService::class);
    }
}
