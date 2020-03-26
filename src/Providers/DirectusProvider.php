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
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

/**
 * Directus provider.
 */
class DirectusProvider extends ServiceProvider
{
    /**
     * Service register.
     */
    public function register(): void
    {
        $this->registerConfigs();
        $this->registerDependencies();
    }

    /**
     * Service boot.
     */
    public function boot(): void
    {
        $this->bootConfigs();
        $this->bootRoutes();
        $this->bootMigrations();
    }

    /**
     * Merges configuration.
     */
    private function registerConfigs(): void
    {
        /** @var bool $debug */
        $debug = config('app.debug', false);

        // Do not load configs if it's cached.
        if (!$debug && App::configurationIsCached()) {
            return;
        }

        $this->mergeConfigFrom(
            __DIR__.'/../../config/directus.php',
            'directus'
        );
    }

    /**
     * Register dependencies.
     */
    private function registerDependencies(): void
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

    /**
     * Config booting.
     */
    private function bootConfigs(): void
    {
        $this->publishes([
            __DIR__.'/../../config/directus.php' => config_path('directus.php'),
        ], ['config']);
    }

    /**
     * Service boot.
     */
    private function bootRoutes(): void
    {
        /** @var bool $debug */
        $debug = config('app.debug', false);

        // Do not create routes if it's cached.
        // TODO: check whenever `App::` can be replaced with `$this->app->`
        // in https://github.com/nunomaduro/larastan/issues/483
        if (!$debug && App::routesAreCached()) {
            return;
        }

        $this->loadRoutesFrom(__DIR__.'/../../routes/directus.php');
    }

    /**
     * Loads directus migrations.
     */
    private function bootMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}
