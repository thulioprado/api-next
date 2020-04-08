<?php

declare(strict_types=1);

namespace Directus\Providers;

use Directus\Contracts\Database\Collection as CollectionContract;
use Directus\Contracts\Database\Database as DatabaseContract;
use Directus\Database\Collection;
use Directus\Database\Database;
use Directus\Directus;
use Illuminate\Foundation\Application;
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
        $this->app->bindIf(Directus::class, Directus::class);
        $this->app->bindIf(CollectionContract::class, Collection::class);
        $this->app->bindIf(DatabaseContract::class, function (Application $app, array $parameters): DatabaseContract {
            $database = $parameters['name'] ?? 'data';

            /** @var string $connection */
            $connection = config("directus.databases.{$database}.connection", 'default');
            if ($connection === 'default') {
                $connection = config('database.default', 'mysql');
            }

            return $this->app->make(Database::class, [
                'connection' => $connection,
                'prefix' => config("directus.databases.{$database}.options.prefix"),
            ]);
        });
    }
}
