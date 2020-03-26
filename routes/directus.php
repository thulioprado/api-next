<?php

declare(strict_types=1);

use Directus\Controllers\CollectionController;
use Directus\Controllers\ServerController;
use Directus\Middlewares\CollectionMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(config('directus.routes.options', [
    'prefix' => '/',
]), function (): void {
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
        'middleware' => [
            CollectionMiddleware::class,
        ],
    ], function (): void {
        // Collection
        Route::get('{collection}', [CollectionController::class, 'index']);
        Route::get('{collection}/{id}', [CollectionController::class, 'show']);
    });
});
