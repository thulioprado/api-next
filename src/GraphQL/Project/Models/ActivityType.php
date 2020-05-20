<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Type;
use Directus\GraphQL\Types\Types;

class ActivityType extends Type
{
    protected function name(): string
    {
        return 'Activity';
    }

    protected function description(): string
    {
        return 'Directus activity information.';
    }

    protected function fields(): array
    {
        return [
            'id' => [
                'type' => Types::required(Types::string()),
                'description' => 'Unique activity id.',
            ],
            'collection_id' => [
                'type' => Types::required(Types::string()),
                'description' => 'Collection identifier in which the item resides.',
            ],
            'action' => [
                'type' => Types::required(Types::string()),
                'description' => 'Action that was performed. One of authenticate, comment, upload, create, update, delete, soft-delete, revert.',
            ],
            'action_by' => [
                'type' => Types::string(),
                'description' => 'Unique identifier of the user account who caused this action.',
            ],
            'action_on' => [
                'type' => Types::string(),
                'description' => 'When the action happened.',
            ],
            'ip' => [
                'type' => Types::required(Types::string()),
                'description' => 'The IP address of the user at the time the action took place.',
            ],
            'user_agent' => [
                'type' => Types::required(Types::string()),
                'description' => 'User agent string of the browser the user used when the action took place.',
            ],
            'item' => [
                'type' => Types::required(Types::string()),
                'description' => 'Unique identifier for the item the action applied to. This is always a string, even for integer primary keys.',
            ],
            'edited_on' => [
                'type' => Types::string(),
                'description' => 'When the action record was edited. This currently only applies to comments, as activity records can\'t be modified.',
            ],
            'comment' => [
                'type' => Types::required(Types::string()),
                'description' => 'User comment. This will store the comments that show up in the right sidebar of the item edit page in the admin app.',
            ],
            'comment_deleted_on' => [
                'type' => Types::string(),
                'description' => 'When and if the comment was (soft-)deleted.',
            ],
            // TODO: relationships
        ];
    }
}
