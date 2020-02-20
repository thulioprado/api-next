<?php

declare(strict_types=1);

return [
    'debug' => true,
    'routes' => [
        'base' => '/',
        'admin' => '/admin',
    ],
    'identifier' => [
        'provider' => '\Directus\Laravel\Identifiers\PathIdentifer',
        'parameters' => [],
    ],
];
