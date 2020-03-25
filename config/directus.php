<?php

declare(strict_types=1);

return [
    'debug' => true,
    'routes' => [
        'options' => [
            'prefix' => '/directus',
        ],
    ],
    'databases' => [
        'data' => [
            'connection' => 'default',
        ],
        'system' => [
            'connection' => 'default',
            'options' => [
                'prefix' => 'directus_',
            ],
        ],
    ],
    'collections' => [
        'prefix' => 'directus_',
    ],
];
