<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server\Resolvers;

class QueryResolver
{
    /**
     * Resolves the ping field.
     */
    public static function resolvePing(): string
    {
        return 'pong';
    }

    /**
     * Resolves the information field.
     */
    public static function resolveInfo(): array
    {
        return [
            'directus' => [
                'version' => directus()->version(),
                'extensions' => [],
            ],
            'environment' => [
                'name' => config('app.env'),
                'server' => @$_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
                'container' => (bool) config('directus.env.container'),
                'os' => php_uname(),
            ],
            'php' => [
                'arch' => PHP_INT_SIZE > 4 ? 'x64' : 'x86',
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
        ];
    }

    /**
     * Resolves the projects field.
     */
    public static function resolveProjects(): array
    {
        return [
            [
                'id' => config('directus.project.id'),
            ],
        ];
    }
}
