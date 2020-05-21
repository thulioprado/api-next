<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class FolderType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Folder',
            'description' => 'Directus folder information.',
            'fields' => [
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
            ],
        ]);
    }
}
