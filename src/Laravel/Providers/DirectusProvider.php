<?php

declare(strict_types=1);

namespace Directus\Laravel\Providers;

use Directus\Framework\Builder;
use Directus\Framework\Contracts\Collections\Collection;
use Directus\Framework\Directus;
use Directus\Laravel\Controllers\CollectionController;
use Directus\Laravel\Controllers\ServerController;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
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
    public function boot(Router $router): void
    {
        $this->bootConfigs();
        $this->bootRoutes($router);
    }

    /**
     * Merges configuration.
     */
    private function registerConfigs(): void
    {
        /** @var bool */
        $debug = config('app.debug', false);

        // Do not load configs if it's cached.
        if ($this->app->configurationIsCached() && !$debug) {
            return;
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../Config/directus.php',
            'directus'
        );
    }

    /**
     * Register dependencies.
     */
    private function registerDependencies(): void
    {
        dd(resolve(Manager::class));
        $this->app->singleton(Directus::class, function (): Directus {
            return Builder::create()
                ->useConfiguration(config('directus', []))
                ->useDatabaseManager(resolve(Manager::class))
                ->build();
        });
    }

    /**
     * Config booting.
     */
    private function bootConfigs(): void
    {
        $this->publishes([
            __DIR__ . '/../Config/directus.php' => config_path('directus.php'),
        ], ['config']);
    }

    /**
     * Service boot.
     */
    private function bootRoutes(): void
    {
        /** @var bool */
        $debug = config('app.debug', false);

        // Do not create routes if it's cached.
        if ($this->app->routesAreCached() && !$debug) {
            return;
        }

        $options = config('directus.routes.options', [
            'prefix' => '/',
        ]);

        // Directus base
        Route::group($options, function (): void {
            // Server
            // https://docs.directus.io/api/server.html#server
            Route::group([
                'prefix' => 'server',
            ], function (): void {
                Route::get('info', [ServerController::class, 'info']);
                Route::get('ping', [ServerController::class, 'ping']);
            });

            // Items
            Route::group([
                'prefix' => 'items',
            ], function (): void {
                // Collection
                Route::get('{collection}', [CollectionController::class, 'index']);
                Route::get('{collection}/{id}', [CollectionController::class, 'show']);
            });
        });
    }
}
