<?php

declare(strict_types=1);

return [
    'debug' => true,
    'routes' => [
        'base' => '/',
        'admin' => '/admin',
    ],
    'databases' => [
        'filesystem' => [
            'file' => [
                'path' => config_path('database.php'),
                'key' => 'connections',
            ],
        ],
    ],
    'identifier' => [
        'provider' => '\Directus\Laravel\Identifiers\ParameterIdentifier',
        'parameters' => [],
    ],
];
