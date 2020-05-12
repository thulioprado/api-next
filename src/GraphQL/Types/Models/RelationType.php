<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Type;
use Directus\GraphQL\Types\Types;

class RelationType extends Type
{
    protected function name(): string
    {
        return 'Relation';
    }

    protected function description(): string
    {
        return 'Directus relation information.';
    }

    protected function fields(): array
    {
        return [
            'id' => [
                'type' => Types::required(Types::string()),
                'description' => 'Unique relation id.',
            ],
            'field_many' => [
                'type' => Types::required(Types::string()),
                'description' => 'Foreign key. Field that holds the primary key of the related collection.',
            ],
            'field_one' => [
                'type' => Types::required(Types::string()),
                'description' => 'Alias column that serves as the one side of the relationship.',
            ],
            'junction_field' => [
                'type' => Types::required(Types::string()),
                'description' => 'Field on the junction table that holds the primary key of the related collection.',
            ],

            // TODO: relationships
        ];
    }
}
