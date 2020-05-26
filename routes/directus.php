<?php

declare(strict_types=1);

use Directus\Controllers\ActivityController;
use Directus\Controllers\AssetController;
use Directus\Controllers\AuthController;
use Directus\Controllers\CollectionController;
use Directus\Controllers\FieldController;
use Directus\Controllers\FileController;
use Directus\Controllers\FolderController;
use Directus\Controllers\GraphQLController;
use Directus\Controllers\InterfaceController;
use Directus\Controllers\ItemController;
use Directus\Controllers\LayoutController;
use Directus\Controllers\MailController;
use Directus\Controllers\ModuleController;
use Directus\Controllers\PermissionController;
use Directus\Controllers\PresetController;
use Directus\Controllers\ProjectController;
use Directus\Controllers\RelationController;
use Directus\Controllers\RevisionController;
use Directus\Controllers\RoleController;
use Directus\Controllers\ScimController;
use Directus\Controllers\ServerController;
use Directus\Controllers\SettingsController;
use Directus\Controllers\TypeController;
use Directus\Controllers\UserController;
use Directus\Controllers\UtilsController;
use Directus\Controllers\WebhookController;
use Directus\Middlewares\CollectionMiddleware;
use Directus\Middlewares\DirectusMiddleware;
use Directus\Middlewares\RequestMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('directus.routes.base', '/'),
    'as' => 'route.',
    'middleware' => [
        DirectusMiddleware::class,
        RequestMiddleware::class,
    ],
], static function (): void {
    // GraphQL
    // https://docs.directus.io/api/graphql.html
    Route::group([
        'prefix' => 'graphql',
        'as' => 'graphql.',
    ], static function (): void {
        Route::get('', [GraphQLController::class, 'system'])->name('get');
        Route::post('', [GraphQLController::class, 'system'])->name('post');
        Route::get('project', [GraphQLController::class, 'project'])->name('get');
        Route::post('project', [GraphQLController::class, 'project'])->name('post');
    });

    // Server
    // https://docs.directus.io/api/server.html
    Route::group([
        'prefix' => 'server',
        'as' => 'server.',
    ], static function (): void {
        Route::get('info', [ServerController::class, 'info'])->name('info');
        Route::get('ping', [ServerController::class, 'ping'])->name('ping');
        Route::get('projects', [ServerController::class, 'projects'])->name('projects.all');
        Route::post('projects', [ServerController::class, 'createProject'])->name('projects.create');
        Route::delete('projects/{key}', [ServerController::class, 'deleteProject'])->name('projects.delete');
    });

    // Interface
    Route::get('interfaces', [InterfaceController::class, 'interfaces'])->name('interfaces');

    // Layout
    Route::get('layouts', [LayoutController::class, 'layouts'])->name('layouts');

    // Module
    Route::get('modules', [ModuleController::class, 'modules'])->name('modules');

    // Type
    Route::get('types', [TypeController::class, 'types'])->name('types');

    Route::group([
        'prefix' => config('directus.project.id', 'api'),
        'as' => 'project.',
    ], static function (): void {
        // Project
        Route::get('', [ProjectController::class, 'info'])->name('info');
        Route::post('update', [ProjectController::class, 'update'])->name('update');

        // Authentication
        // https://docs.directus.io/api/authentication.html
        Route::group([
            'prefix' => 'auth',
            'as' => 'auth.',
        ], static function (): void {
            Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
            Route::get('sessions', [AuthController::class, 'sessions'])->name('sessions');
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
            Route::post('logout/{key}', [AuthController::class, 'logoutUser'])->name('logout.user'); // TODO: check this name and functionallity.
            Route::post('logout/{key}/{id}', [AuthController::class, 'logoutUserId'])->name('logout.userId'); // TODO: check this name and functionallity.
            Route::post('password/request', [AuthController::class, 'requestPassword'])->name('password.request');
            Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');
            Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
            Route::get('sso', [AuthController::class, 'sso'])->name('sso');
            Route::post('sso/access_token', [AuthController::class, 'ssoAccessToken'])->name('sso.accessToken'); // TODO: check this name and functionallity.
            Route::get('sso/{provider}', [AuthController::class, 'ssoFetchProvider'])->name('sso.provider.fetch'); // TODO: check this name and functionallity.
            Route::post('sso/{provider}', [AuthController::class, 'ssoCreateProvider'])->name('sso.provider.create'); // TODO: check this name and functionallity.
            Route::get('sso/{provider}/callback', [AuthController::class, 'ssoProviderCallback'])->name('sso.provider.callback'); // TODO: check this name and functionallity.
            Route::get('check', [AuthController::class, 'check'])->name('check');
        });

        // Items
        // https://docs.directus.io/api/items.html
        Route::group([
            'prefix' => 'items',
            'as' => 'items.',
            'middleware' => [
                CollectionMiddleware::class,
            ],
        ], static function (): void {
            Route::get('{collection}', [ItemController::class, 'all'])->name('all');
            Route::get('{collection}/{key}', [ItemController::class, 'fetch'])->name('fetch');
            Route::post('{collection}', [ItemController::class, 'create'])->name('create');
            Route::patch('{collection}/{key}', [ItemController::class, 'update'])->name('update');
            Route::delete('{collection}/{key}', [ItemController::class, 'delete'])->name('delete');
            Route::get('{collection}/{key}/revisions/{offset?}', [ItemController::class, 'revisions'])->name('revisions');
            Route::patch('{collection}/{key}/revert/{revision}', [ItemController::class, 'revert'])->name('revert');
        });

        // Files
        // https://docs.directus.io/api/files.html
        Route::group([
            'prefix' => 'files',
            'as' => 'files.',
        ], static function (): void {
            Route::get('', [FileController::class, 'all'])->name('all');
            Route::get('{key}', [FileController::class, 'fetch'])->name('fetch');
            Route::post('', [FileController::class, 'create'])->name('create');
            Route::patch('{key}', [FileController::class, 'update'])->name('update');
            Route::delete('{key}', [FileController::class, 'delete'])->name('delete');
            Route::get('{key}/revisions/{offset?}', [FileController::class, 'revisions'])->name('revisions');
        });

        // Assets
        // https://docs.directus.io/api/assets.html
        Route::get('assets/{key}', [AssetController::class, 'fetch'])->name('asset');

        // Activities
        // https://docs.directus.io/api/activity.html
        Route::group([
            'prefix' => 'activities',
            'as' => 'activities.',
        ], static function (): void {
            Route::get('', [ActivityController::class, 'all'])->name('all');
            Route::get('{key}', [ActivityController::class, 'fetch'])->name('fetch');
            Route::post('comment', [ActivityController::class, 'createComment'])->name('comment.create');
            Route::patch('comment/{key}', [ActivityController::class, 'updateComment'])->name('comment.update');
            Route::delete('comment/{key}', [ActivityController::class, 'deleteComment'])->name('comment.delete');
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

        // Presets
        // https://docs.directus.io/api/collection-presets.html
        Route::group([
            'prefix' => 'presets',
            'as' => 'presets.',
        ], static function (): void {
            Route::get('', [PresetController::class, 'all'])->name('all');
            Route::get('{key}', [PresetController::class, 'fetch'])->name('fetch');
            Route::post('', [PresetController::class, 'create'])->name('create');
            Route::patch('{key}', [PresetController::class, 'update'])->name('update');
            Route::delete('{key}', [PresetController::class, 'delete'])->name('delete');
        });

        // Fields
        // https://docs.directus.io/api/fields.html
        Route::group([
            'prefix' => 'fields',
            'as' => 'fields.',
        ], static function (): void {
            Route::get('', [FieldController::class, 'all'])->name('all');
            Route::get('{collection}', [FieldController::class, 'allCollectionFields'])->name('collection.all');
            Route::get('{collection}/{key}', [FieldController::class, 'fetchCollectionField'])->name('collection.fetch');
            Route::post('{collection}', [FieldController::class, 'createCollectionField'])->name('collection.create');
            Route::patch('{collection}/{key}', [FieldController::class, 'updateCollectionField'])->name('collection.update');
            Route::delete('{collection}/{key}', [FieldController::class, 'deleteCollectionField'])->name('collection.delete');
        });

        // Folders
        // https://docs.directus.io/api/folders.html
        Route::group([
            'prefix' => 'folders',
            'as' => 'folders.',
        ], static function (): void {
            Route::get('', [FolderController::class, 'all'])->name('all');
            Route::get('{key}', [FolderController::class, 'fetch'])->name('fetch');
            Route::post('', [FolderController::class, 'create'])->name('create');
            Route::patch('{key}', [FolderController::class, 'update'])->name('update');
            Route::delete('{key}', [FolderController::class, 'delete'])->name('delete');
        });

        // Mail
        // https://docs.directus.io/api/mail.html
        Route::post('mail', [MailController::class, 'send'])->name('mail');

        // Permissions
        // https://docs.directus.io/api/permissions.html
        Route::group([
            'prefix' => 'permissions',
            'as' => 'permissions.',
        ], static function (): void {
            Route::get('', [PermissionController::class, 'all'])->name('all');
            Route::get('{key}', [PermissionController::class, 'fetch'])->name('fetch');
            Route::post('', [PermissionController::class, 'create'])->name('create');
            Route::patch('{key}', [PermissionController::class, 'update'])->name('update');
            Route::delete('{key}', [PermissionController::class, 'delete'])->name('delete');
            Route::get('me/{collection?}', [PermissionController::class, 'me'])->name('me');
        });

        // Relations
        // https://docs.directus.io/api/relations.html
        Route::group([
            'prefix' => 'relations',
            'as' => 'relations.',
        ], static function (): void {
            Route::get('', [RelationController::class, 'all'])->name('all');
            Route::get('{key}', [RelationController::class, 'fetch'])->name('fetch');
            Route::post('', [RelationController::class, 'create'])->name('create');
            Route::patch('{key}', [RelationController::class, 'update'])->name('update');
            Route::delete('{key}', [RelationController::class, 'delete'])->name('delete');
        });

        // Revisions
        // https://docs.directus.io/api/revisions.html
        Route::group([
            'prefix' => 'revisions',
            'as' => 'revisions.',
        ], static function (): void {
            Route::get('', [RevisionController::class, 'all'])->name('all');
            Route::get('{key}', [RevisionController::class, 'fetch'])->name('fetch');
        });

        // Roles
        // https://docs.directus.io/api/roles.html
        Route::group([
            'prefix' => 'roles',
            'as' => 'roles.',
        ], static function (): void {
            Route::get('', [RoleController::class, 'all'])->name('all');
            Route::get('{key}', [RoleController::class, 'fetch'])->name('fetch');
            Route::post('', [RoleController::class, 'create'])->name('create');
            Route::patch('{key}', [RoleController::class, 'update'])->name('update');
            Route::delete('{key}', [RoleController::class, 'delete'])->name('delete');
        });

        // SCIM
        // https://docs.directus.io/api/scim.html
        Route::group([
            'prefix' => 'scim/v2',
            'as' => 'scim.',
        ], static function (): void {
            Route::get('Users', [ScimController::class, 'allUsers'])->name('user.all');
            Route::get('Users/{key}', [ScimController::class, 'fetchUser'])->name('user.fetch');
            Route::post('Users', [ScimController::class, 'createUser'])->name('user.create');
            Route::patch('Users/{key}', [ScimController::class, 'updateUser'])->name('user.update');
            Route::delete('Users/{key}', [ScimController::class, 'deleteUser'])->name('user.delete');
            Route::get('Groups', [ScimController::class, 'allGroups'])->name('group.all');
            Route::get('Groups/{key}', [ScimController::class, 'fetchGroup'])->name('group.fetch');
            Route::post('Groups', [ScimController::class, 'createGroup'])->name('group.create');
            Route::patch('Groups/{key}', [ScimController::class, 'updateGroup'])->name('group.update');
            Route::delete('Groups/{key}', [ScimController::class, 'deleteGroup'])->name('group.delete');
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
            Route::get('fields', [SettingsController::class, 'fields'])->name('fields');
        });

        // Users
        // https://docs.directus.io/api/users.html
        Route::group([
            'prefix' => 'users',
            'as' => 'users.',
        ], static function (): void {
            Route::get('', [UserController::class, 'all'])->name('all');
            Route::get('me', [UserController::class, 'current'])->name('all');
            Route::get('{key}', [UserController::class, 'fetch'])->name('fetch');
            Route::post('', [UserController::class, 'create'])->name('create');
            Route::patch('{key}', [UserController::class, 'update'])->name('update');
            Route::delete('{key}', [UserController::class, 'delete'])->name('delete');
            Route::post('invite/{token?}', [UserController::class, 'invite'])->name('invite');
            Route::patch('{key}/tracking/page', [UserController::class, 'updateLastPage'])->name('update.lastPage');
            Route::get('{key}/revisions/{offset?}', [UserController::class, 'revisions'])->name('revisions');
            Route::post('{key}/activate_2fa', [UserController::class, 'activateTwoFactor'])->name('activateTwoFactor');
        });

        // Utils
        // https://docs.directus.io/api/utilities.html
        Route::group([
            'prefix' => 'utils',
            'as' => 'utils.',
        ], static function (): void {
            Route::get('random/string', [UtilsController::class, 'randomString'])->name('string');
            Route::post('hash/match', [UtilsController::class, 'hashMatch'])->name('hash.match');
            Route::post('hash', [UtilsController::class, 'hashCreate'])->name('hash.create');
            Route::post('2fa_secret', [UtilsController::class, 'generateTFSecret'])->name('2fa_secret');
        });

        // Webhooks
        Route::group([
            'prefix' => 'webhooks',
            'as' => 'webhooks.',
        ], static function (): void {
            Route::get('', [WebhookController::class, 'all'])->name('all');
            Route::get('{key}', [WebhookController::class, 'fetch'])->name('fetch');
            Route::post('', [WebhookController::class, 'create'])->name('create');
            Route::patch('{key}', [WebhookController::class, 'update'])->name('update');
            Route::delete('{key}', [WebhookController::class, 'delete'])->name('delete');
            Route::get('{key}/revisions/{offset?}', [WebhookController::class, 'revisions'])->name('revisions');
        });
    });
});
