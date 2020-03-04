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
        'data' => 'default',
        'system' => 'default',
    ],
    'models' => [
        'prefix' => 'directus_',
    ],
];
