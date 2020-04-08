<?php

declare(strict_types=1);

use Directus\Controllers\CollectionController;
use Directus\Controllers\ServerController;
use Directus\Controllers\SettingsController;
use Directus\Controllers\UtilsController;
use Directus\Middlewares\CollectionMiddleware;
use Directus\Middlewares\DirectusMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('directus.routes.base', '/'),
    'middleware' => [
        DirectusMiddleware::class,
    ],
], function (): void {
    // Server
    // https://docs.directus.io/api/server.html
    Route::group([
        'prefix' => 'server',
    ], function (): void {
        Route::get('info', [ServerController::class, 'info']);
        Route::get('ping', [ServerController::class, 'ping']);
        Route::get('projects', [ServerController::class, 'projects']);
    });

    Route::group([
        'prefix' => config('directus.project.id', 'api'),
    ], function (): void {
        // Utils
        // https://docs.directus.io/api/utilities.html
        Route::group([
            'prefix' => 'utils',
        ], function (): void {
            Route::get('random/string', [UtilsController::class, 'randomString']);
            Route::post('hash/match', [UtilsController::class, 'hashVerify']);
            Route::post('hash/verify', [UtilsController::class, 'hashVerify']);
            Route::post('hash', [UtilsController::class, 'hashCreate']);
        });

        // Settings
        // https://docs.directus.io/api/settings.html
        Route::group([
            'prefix' => 'settings',
        ], function (): void {
            Route::get('{key}', [SettingsController::class, 'one']);
            Route::get('', [SettingsController::class, 'all']);
            Route::post('', [SettingsController::class, 'create']);
            Route::patch('{key}', [SettingsController::class, 'update']);
            Route::delete('{key}', [SettingsController::class, 'delete']);
        });

        // Items
        Route::group([
            'prefix' => 'items',
            'middleware' => [
                CollectionMiddleware::class,
            ],
        ], function (): void {
            // Collection
            Route::get('{collection}', [CollectionController::class, 'index']);
            Route::get('{collection}/{id}', [CollectionController::class, 'show']);
        });
    });
});
