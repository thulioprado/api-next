<?php

declare(strict_types=1);

namespace Directus\Laravel\Providers;

use Directus\Laravel\Controllers\ProjectController;
use Directus\Laravel\Controllers\ServerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Directus provider.
 */
class RoutesProvider extends ServiceProvider
{
    /**
     * Service boot.
     */
    public function boot(): void
    {
        /** @var bool */
        $debug = config('directus.debug', false);

        // Do not create routes if it's cached.
        if ($this->app->routesAreCached() && !$debug) {
            return;
        }

        $base = config('directus.routes.base', '/');

        // Directus base
        Route::group([
            'prefix' => $base,
        ], function (): void {
            // Server
            // https://docs.directus.io/api/server.html#server
            Route::group([
                'prefix' => 'server',
            ], function (): void {
                Route::get('info', [ServerController::class, 'info']);
                Route::get('ping', [ServerController::class, 'ping']);
                Route::get('projects', [ServerController::class, 'projects']);
            });

            // Project
            Route::group([
                'prefix' => '{project}',
            ], function (): void {
                Route::get('{collection}/items', [ProjectController::class, 'test']);
            });
        });
    }
}
