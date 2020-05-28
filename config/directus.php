<?php

declare(strict_types=1);

return [
    'env' => [
        'container' => env('DIRECTUS_CONTAINER', false),
    ],
    'routes' => [
        'base' => env('DIRECTUS_ROUTE_BASE', '/'),
    ],
    'databases' => [
        'data' => [
            'connection' => env('DIRECTUS_DATABASE_CONNECTION', 'default'),
            'options' => [
                'prefix' => env('DIRECTUS_DATABASE_PREFIX', ''),
            ],
        ],
        'system' => [
            'connection' => env('DIRECTUS_SYSTEM_CONNECTION', 'default'),
            'options' => [
                'prefix' => env('DIRECTUS_SYSTEM_PREFIX', 'directus_'),
            ],
        ],
    ],
    'project' => [
        'id' => env('DIRECTUS_PROJECT_ID', 'directus'),
        'graphql' => [
            'schema' => [
                'cache' => 'file',
            ],
        ],
    ],
];
