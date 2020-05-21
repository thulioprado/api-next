<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class RevisionType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Revision',
            'description' => 'Directus revision information.',
            'fields' => [
                'id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Unique revision id.',
                ],
                'activity_id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Unique identifier for the activity record.',
                ],
                'collection_id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Collection of the updated item.',
                ],
                'item' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Primary key of updated item.',
                ],
                'data' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Copy of item state at time of update.',
                ],
                'delta' => [
                    'type' => Types::string(),
                    'description' => 'Changes between the previous and the current revision.',
                ],
                'parent_collection_id' => [
                    'type' => Types::string(),
                    'description' => 'If the current item was updated relationally, this is the collection of the parent item.',
                ],
                'parent_item' => [
                    'type' => Types::string(),
                    'description' => 'If the current item was updated relationally, this is the unique identifier of the parent item.',
                ],
                'parent_changed' => [
                    'type' => Types::required(Types::boolean()),
                    'description' => 'If the current item was updated relationally, this shows if the parent item was updated as well.',
                ],

                // TODO: relationships
            ],
        ]);
    }
}
