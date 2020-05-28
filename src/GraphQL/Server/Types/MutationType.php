<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server\Types;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class MutationType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Mutation',
            'description' => 'Server mutations.',
            'fields' => [
                'sum' => [
                    'type' => Types::required(Types::integer()),
                    'args' => [
                        'param1' => Types::required(Types::integer()),
                        'param2' => Types::required(Types::integer()),
                    ],
                    'description' => 'Example mutation.',
                    'resolve' => function ($root, array $args) {
                        return $args['param1'] + $args['param2'];
                    },
                ],
            ],
        ]);
    }
}
