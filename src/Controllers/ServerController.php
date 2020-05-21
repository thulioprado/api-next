<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Server controller.
 */
class ServerController extends BaseController
{
    /**
     * Server information.
     */
    public function info(): JsonResponse
    {
        return directus()->respond()->with([
            'directus' => [
                'version' => 'TODO: automatically fetch current version.',
                // TODO: fill with plugins/extensions
                'plugins' => [
                    /*
                    [
                        'name' => 'directus/extension',
                        'version' => '1.4.6',
                    ]
                    */
                ],
            ],
            'env' => [
                'name' => config('app.env'),
                'debug' => (bool) config('app.debug'),
                'server' => @$_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
                'container' => (bool) config('directus.env.container'),
                'os' => php_uname(),
            ],
            'php' => [
                'architecture' => PHP_INT_SIZE > 4 ? 'x64' : 'x86',
                'version' => PHP_VERSION,
                'settings' => [
                    'upload_max_filesize' => ini_get('upload_max_filesize'),
                ],
                'extensions' => [
                    'pdo' => \extension_loaded('pdo'),
                    'curl' => \extension_loaded('curl'),
                    'gd' => \extension_loaded('gd'),
                    'fileinfo' => \extension_loaded('fileinfo'),
                    'mbstring' => \extension_loaded('mbstring'),
                    'json' => \extension_loaded('json'),
                ],
            ],
            'laravel' => [
                'version' => app()->version(),
                'locale' => app()->getLocale(),
            ],
        ]);
    }

    // TODO: implement a "compatibility check", to check server settings, extensions, php version,
    //       upload size (if project config is lower or qual the php ini value, etc)

    /**
     * Server ping.
     */
    public function ping(): JsonResponse
    {
        return directus()->respond()->withQuery(
            directus()->graphql()->server()->execute('
                query {
                    ping
                }
            ')
        );
    }

    /**
     * Gets the server list.
     */
    public function projects(): JsonResponse
    {
        // TODO: dynamic load of projects
        return directus()->respond()->public()->withQuery(
            directus()->graphql()->server()->execute('
                query {
                    projects {
                        id
                    }
                }
            ')
        )->transform(static function ($response) {
            $response->set('data', collect($response->get('data.projects'))->pluck('id')->toArray());
        });
    }
}
