<?php

declare(strict_types=1);

use Directus\Controllers\ActivityController;
use Directus\Controllers\CollectionController;
use Directus\Controllers\PresetController;
use Directus\Controllers\ProjectController;
use Directus\Controllers\RoleController;
use Directus\Controllers\ServerController;
use Directus\Controllers\SettingsController;
use Directus\Controllers\UserController;
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
    ], static function (): void {
        Route::get('info', [ServerController::class, 'info'])->name('info');
        Route::get('ping', [ServerController::class, 'ping'])->name('ping');
        Route::get('projects', [ServerController::class, 'projects'])->name('projects');
    });

    Route::group([
        'prefix' => config('directus.project.id', 'api'),
        'as' => 'project.',
    ], static function (): void {
        // Project
        Route::get('', [ProjectController::class, 'info'])->name('info');

        // Utils
        // https://docs.directus.io/api/utilities.html
        Route::group([
            'prefix' => 'utils',
            'as' => 'utils.',
        ], static function (): void {
            Route::get('random/string', [UtilsController::class, 'randomString'])->name('string');
            Route::post('hash/match', [UtilsController::class, 'hashVerify'])->name('hash.match');
            Route::post('hash/verify', [UtilsController::class, 'hashVerify'])->name('hash.verify');
            Route::post('hash', [UtilsController::class, 'hashCreate'])->name('hash.create');
        });

        // Activities
        // https://docs.directus.io/api/activity.html
        Route::group([
            'prefix' => 'activity',
            'as' => 'activity.',
        ], static function (): void {
            Route::get('', [ActivityController::class, 'all'])->name('all');
            Route::post('comment', [ActivityController::class, 'createComment'])->name('comment.create');
            Route::patch('comment/{key}', [ActivityController::class, 'updateComment'])->name('comment.update');
            Route::delete('comment/{key}', [ActivityController::class, 'deleteComment'])->name('comment.delete');
            Route::get('{key}', [ActivityController::class, 'fetch'])->name('fetch');
        });

        // Presets
        // https://docs.directus.io/api/collection-presets.html
        Route::group([
            'prefix' => 'collection_presets',
            'as' => 'presets.',
        ], static function (): void {
            Route::get('', [PresetController::class, 'all'])->name('all');
            Route::get('{key}', [PresetController::class, 'fetch'])->name('fetch');
            Route::post('', [PresetController::class, 'create'])->name('create');
            Route::patch('{key}', [PresetController::class, 'update'])->name('update');
            Route::delete('{key}', [PresetController::class, 'delete'])->name('delete');
        });

        // Users
        // https://docs.directus.io/api/users.html
        Route::group([
            'prefix' => 'users',
            'as' => 'presets.',
        ], static function (): void {
            Route::get('', [UserController::class, 'all'])->name('all');
            Route::get('{key}', [UserController::class, 'fetch'])->name('fetch');
            Route::post('', [UserController::class, 'create'])->name('create');
            Route::patch('{key}', [UserController::class, 'update'])->name('update');
            Route::delete('{key}', [UserController::class, 'delete'])->name('delete');
        });

        // Roles
        // https://docs.directus.io/api/roles.html
        Route::group([
            'prefix' => 'roles',
            'as' => 'presets.',
        ], static function (): void {
            Route::get('', [RoleController::class, 'all'])->name('all');
            Route::get('{key}', [RoleController::class, 'fetch'])->name('fetch');
            Route::post('', [RoleController::class, 'create'])->name('create');
            Route::patch('{key}', [RoleController::class, 'update'])->name('update');
            Route::delete('{key}', [RoleController::class, 'delete'])->name('delete');
        });

        // Setting
        // https://docs.directus.io/api/settings.html
        Route::group([
            'prefix' => 'settings',
            'as' => 'settings.',
        ], static function (): void {
            Route::get('', [SettingsController::class, 'all'])->name('all');
            Route::get('{key}', [SettingsController::class, 'fetch'])->name('fetch');
            Route::post('', [SettingsController::class, 'create'])->name('create');
            Route::patch('{key}', [SettingsController::class, 'update'])->name('update');
            Route::delete('{key}', [SettingsController::class, 'delete'])->name('delete');
        });

        // Collections
        // https://docs.directus.io/api/collections.html
        Route::group([
            'prefix' => 'collections',
            'as' => 'collections.',
        ], static function (): void {
            Route::get('', [CollectionController::class, 'all'])->name('all');
            Route::get('{key}', [CollectionController::class, 'fetch'])->name('fetch');
            Route::post('', [CollectionController::class, 'create'])->name('create');
            Route::patch('{key}', [CollectionController::class, 'update'])->name('update');
            Route::delete('{key}', [CollectionController::class, 'delete'])->name('delete');
        });

        // Items
        Route::group([
            'prefix' => 'items',
            'as' => 'items.',
            'middleware' => [
                CollectionMiddleware::class,
            ],
        ], static function (): void {
            Route::get('{collection}', [CollectionController::class, 'all'])->name('all');
            Route::get('{collection}/{id}', [CollectionController::class, 'fetch'])->name('fetch');
        });
    });
});
