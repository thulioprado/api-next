<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Type;
use Directus\GraphQL\Types\Types;

class CollectionType extends Type
{
    protected function name(): string
    {
        return 'Collection';
    }

    protected function description(): string
    {
        return 'Directus collection information.';
    }

    protected function fields(): array
    {
        return [
            'id' => [
                'type' => Types::required(Types::string()),
                'description' => 'Unique collection id.',
            ],
            'name' => [
                'type' => Types::required(Types::string()),
                'description' => 'Unique name of the collection.',
            ],
            'note' => [
                'type' => Types::string(),
                'description' => 'A note describing the collection.',
            ],
            'hidden' => [
                'type' => Types::required(Types::boolean()),
                'description' => 'Whether or not the collection is hidden from the navigation in the admin app.',
            ],
            'single' => [
                'type' => Types::required(Types::boolean()),
                'description' => 'Whether or not the collection is treated as a single record.',
            ],
            'icon' => [
                'type' => Types::string(),
                'description' => 'Name of a Google Material Design Icon that\'s assigned to this collection.',
            ],
            'translation' => [
                'type' => Types::json(),
                'description' => 'Key value pairs of how to show this collection\'s name in different languages in the admin app.',
            ],
            // TODO: relationships and fields
        ];
    }
}
