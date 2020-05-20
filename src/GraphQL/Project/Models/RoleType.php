<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Type;
use Directus\GraphQL\Types\Types;

class RoleType extends Type
{
    protected function name(): string
    {
        return 'Role';
    }

    protected function description(): string
    {
        return 'Directus role information.';
    }

    protected function fields(): array
    {
        return [
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
            'enforce_2fa' => [
                'type' => Types::required(Types::boolean()),
                'description' => 'Whether or not this role enforces the use of 2FA.',
            ],

            // TODO: relationships
        ];
    }
}
