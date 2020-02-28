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
        'data' => 'mysql',
        'system' => 'mysql',
    ],
];
