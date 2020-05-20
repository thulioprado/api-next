<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Type;
use Directus\GraphQL\Types\Types;

class FolderType extends Type
{
    protected function name(): string
    {
        return 'Folder';
    }

    protected function description(): string
    {
        return 'Directus folder information.';
    }

    protected function fields(): array
    {
        return [
            'id' => [
                'type' => Types::required(Types::string()),
                'description' => 'Unique folder id.',
            ],
            'name' => [
                'type' => Types::required(Types::string()),
                'description' => 'Name of the folder.',
            ],
            'parent_id' => [
                'type' => Types::string(),
                'description' => 'Unique identifier of the parent folder. This allows for nested folders.',
            ],

            // TODO: relationships
        ];
    }
}
