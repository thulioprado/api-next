<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class FieldType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Field',
            'description' => 'Directus field information.',
            'fields' => [
                'id' => [
                    'type' => Types::required(Types::string()),
                ],
                'collection_id' => [
                    'type' => Types::required(Types::string()),
                ],
                'name' => [
                    'type' => Types::required(Types::string()),
                ],
                // TODO: relationships
            ],
        ]);
    }
}
