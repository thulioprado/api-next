<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class PermissionType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Permission',
            'description' => 'Directus permission information.',
            'fields' => [
                'id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Unique permission id.',
                ],
                'collection_id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'What status this permission applies to.',
                ],
                'role_id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'What status this permission applies to.',
                ],
                'create' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'If the user can create items. One of none, full.',
                ],
                'read' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'If the user can read items. One of none, mine, role, full.',
                ],
                'update' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'If the user can update items. One of none, mine, role, full.',
                ],
                'delete' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'If the user can update items. One of none, mine, role, full.',
                ],
                'comment' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'If the user can post comments. One of none, create, update, full.',
                ],
                'explain' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'If the user is required to leave a comment explaining what was changed. One of none, create, update, always.',
                ],
                'status' => [
                    'type' => Types::string(),
                    'description' => 'What status this permission applies to.',
                ],
                'read_field_blacklist' => [
                    'type' => Types::string(),
                    'description' => 'Explicitly denies read access for specific fields.',
                ],
                'write_field_blacklist' => [
                    'type' => Types::string(),
                    'description' => 'Explicitly denies write access for specific fields.',
                ],
                'status_blacklist' => [
                    'type' => Types::string(),
                    'description' => 'Explicitly denies specific statuses to be used.',
                ],

                // TODO: relationships
            ],
        ]);
    }
}
