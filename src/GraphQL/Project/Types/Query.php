<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project;

use Directus\GraphQL\Server\Resolvers\PingResolver;
use Directus\GraphQL\Server\Resolvers\ProjectsResolver;
use Directus\GraphQL\Server\Types\PingType;
use Directus\GraphQL\Server\Types\ProjectType;
use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class Query extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Query',
            'description' => 'Project related queries.',
            'fields' => [
                'ping' => [
                    'type' => Types::required(Types::from(PingType::class)),
                    'description' => 'Pings the server instance.',
                    'resolve' => Types::resolver(PingResolver::class),
                ],
                'projects' => [
                    'type' => Types::required(Types::list(Types::required(Types::from(ProjectType::class)))),
                    'resolve' => Types::resolver(ProjectsResolver::class),
                ],
            ],
        ]);
    }

    public function resolveInfo(): array
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

    protected function fields(): array
    {
        return [
            /*
            'info' => [
                'type' => new ObjectType([
                    'name' => 'ServerInfo',
                    'fields' => [
                        'directus' => [
                            'type' => new ObjectType([
                                'name' => 'DirectusInfo',
                                'description' => 'Directus information.',
                                'fields' => [
                                    'version' => [
                                        'type' => Types::required(Types::string()),
                                        'description' => 'The installed Directus version.',
                                    ],
                                    'extensions' => [
                                        'type' => Types::required(Types::list(Types::string())),
                                        'description' => 'List of installed Directus extensions.',
                                    ],
                                ],
                            ]),
                            'description' => 'Directus related information.',
                        ],
                        'environment' => [
                            'type' => new ObjectType([
                                'name' => 'EnvironmentInfo',
                                'description' => 'Environment information.',
                                'fields' => [
                                    'name' => [
                                        'type' => Types::required(Types::string()),
                                        'description' => 'The environment name.',
                                    ],
                                    'server' => [
                                        'type' => Types::required(Types::string()),
                                        'description' => 'The server name.',
                                    ],
                                    'container' => [
                                        'type' => Types::required(Types::boolean()),
                                        'description' => 'Whether the project is running inside a container.',
                                    ],
                                    'os' => [
                                        'type' => Types::required(Types::string()),
                                        'description' => 'The OS name.',
                                    ],
                                ],
                            ]),
                            'description' => 'Environment related information.',
                        ],
                        'php' => [
                            'type' => new ObjectType([
                                'name' => 'PhpInfo',
                                'description' => 'PHP information.',
                                'fields' => [
                                    'arch' => [
                                        'type' => Types::required(Types::string()),
                                        'description' => 'The PHP architecture.',
                                    ],
                                    'version' => [
                                        'type' => Types::required(Types::string()),
                                        'description' => 'The PHP version.',
                                    ],
                                    'settings' => [
                                        'type' => Types::required(Types::json()),
                                        'description' => 'Some PHP settings.',
                                    ],
                                    'extensions' => [
                                        'type' => Types::required(Types::json()),
                                        'description' => 'The key/value pair of extensions used in the project. Indicates if it\'s installed or not.',
                                    ],
                                ],
                            ]),
                            'description' => 'PHP related information.',
                        ],
                    ],
                ]),
                'description' => 'Server information.',
            ],*/
        ];
    }
}
