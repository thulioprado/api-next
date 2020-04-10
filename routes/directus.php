<?php

declare(strict_types=1);

use Directus\Controllers\CollectionController;
use Directus\Controllers\ProjectController;
use Directus\Controllers\ServerController;
use Directus\Controllers\SettingsController;
use Directus\Controllers\UtilsController;
use Directus\Middlewares\CollectionMiddleware;
use Directus\Middlewares\DirectusMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('directus.routes.base', '/'),
    'as' => 'directus.',
    'middleware' => [
        DirectusMiddleware::class,
    ],
], function (): void {
    // Server
    // https://docs.directus.io/api/server.html
    Route::group([
        'prefix' => 'server',
        'as' => 'server.',
    ], function (): void {
        Route::get('info', [ServerController::class, 'info'])->name('info');
        Route::get('ping', [ServerController::class, 'ping'])->name('ping');
        Route::get('projects', [ServerController::class, 'projects'])->name('projects');
    });

    Route::group([
        'prefix' => config('directus.project.id', 'api'),
        'as' => 'project.',
    ], function (): void {
        // Project
        Route::get('', [ProjectController::class, 'info'])->name('info');

        // Utils
        // https://docs.directus.io/api/utilities.html
        Route::group([
            'prefix' => 'utils',
            'as' => 'utils.',
        ], function (): void {
            Route::get('random/string', [UtilsController::class, 'randomString'])->name('string');
            Route::post('hash/match', [UtilsController::class, 'hashVerify'])->name('hash.match');
            Route::post('hash/verify', [UtilsController::class, 'hashVerify'])->name('hash.verify');
            Route::post('hash', [UtilsController::class, 'hashCreate'])->name('hash.create');
        });

        // Setting
        // https://docs.directus.io/api/settings.html
        Route::group([
            'prefix' => 'settings',
            'as' => 'settings.',
        ], function (): void {
            Route::get('', [SettingsController::class, 'all'])->name('all');
            Route::get('{key}', [SettingsController::class, 'one'])->name('one');
            Route::post('', [SettingsController::class, 'create'])->name('create');
            Route::patch('{key}', [SettingsController::class, 'update'])->name('update');
            Route::delete('{key}', [SettingsController::class, 'delete'])->name('delete');
        });

        // Items
        Route::group([
            'prefix' => 'items',
            'as' => 'items.',
            'middleware' => [
                CollectionMiddleware::class,
            ],
        ], function (): void {
            // Collection
            Route::get('{collection}', [CollectionController::class, 'index'])->name('all');
            Route::get('{collection}/{id}', [CollectionController::class, 'show'])->name('one');
        });
    });
});
