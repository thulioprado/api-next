<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class RoleType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Role',
            'description' => 'Directus role information.',
            'fields' => [
                'id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Unique role id.',
                ],
                'name' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Name of the role.',
                ],
                'description' => [
                    'type' => Types::string(),
                    'description' => 'Description of the role.',
                ],
                'ip_whitelist' => [
                    'type' => Types::string(),
                    'description' => 'Array of IP addresses that are allowed to connect to the API as a user of this role.',
                ],
                'external_id' => [
                    'type' => Types::string(),
                    'description' => 'ID used with external services in SCIM.',
                ],
                'module_listing' => [
                    'type' => Types::string(),
                    'description' => 'Custom override for the admin app module bar navigation.',
                ],
                'collection_listing' => [
                    'type' => Types::string(),
                    'description' => 'Custom override for the admin app collection navigation.',
                ],
                'enforce_twofactor' => [
                    'type' => Types::required(Types::boolean()),
                    'description' => 'Whether or not this role enforces the use of 2FA.',
                ],

                // TODO: relationships
            ],
        ]);
    }
}
