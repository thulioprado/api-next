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
        $data = [
            'directus' => [
                'version' => 'TODO: fetch current version.',
            ],
            'env' => [
                'os' => php_uname(),
                'type' => $_SERVER['SERVER_SOFTWARE'],
                'container' => getenv('DIRECTUS_CONTAINER') === '1',
            ],
            'php' => [
                'arch' => PHP_INT_SIZE > 4 ? 'x64' : 'x86',
                'version' => PHP_VERSION,
                'settings' => [
                    'upload_size' => ini_get('upload_max_filesize'),
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
        ];

        return response()->json($data);
    }

    /**
     * Server ping.
     */
    public function ping(): string
    {
        return 'pong';
    }
}
