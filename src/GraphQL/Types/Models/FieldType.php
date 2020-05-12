<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Type;
use Directus\GraphQL\Types\Types;

class FieldType extends Type
{
    protected function name(): string
    {
        return 'Field';
    }

    protected function description(): string
    {
        return 'Directus field information.';
    }

    protected function fields(): array
    {
        return [
            'id' => [
                'type' => Types::required(Types::string()),
            ],
            'collectionId' => [
                'type' => Types::required(Types::string()),
            ],
            'name' => [
                'type' => Types::required(Types::string()),
            ],
        ];
    }
}
