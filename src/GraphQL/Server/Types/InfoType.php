<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server\Types;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class InfoType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Info',
            'description' => 'Server information.',
            'fields' => [
                'pong' => [
                    'type' => Types::string(),
                    'description' => 'The successful pong response.',
                ],
            ],
        ]);
    }
}
