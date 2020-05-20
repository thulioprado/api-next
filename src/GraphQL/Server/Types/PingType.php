<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server\Types;

use GraphQL\Type\Definition\EnumType;

class PingType extends EnumType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Ping',
            'description' => 'Response to server pings.',
            'values' => [
                'pong' => [
                    'description' => 'The successful pong response.',
                    'value' => 'pong',
                ],
            ],
        ]);
    }
}
