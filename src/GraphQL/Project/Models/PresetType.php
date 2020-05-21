<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class PresetType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Preset',
            'description' => 'Directus preset information.',
            'fields' => [
                'id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Unique collection preset id.',
                ],
                'title' => [
                    'type' => Types::string(),
                    'description' => 'Name for the bookmark. If this is set, the collection preset will be considered to be a bookmark.',
                ],
                'collection_id' => [
                    'type' => Types::string(),
                    'description' => 'What collection this collection preset is used for.',
                ],
                'user_id' => [
                    'type' => Types::string(),
                    'description' => 'The unique identifier of the user to whom this collection preset applies.',
                ],
                'role_id' => [
                    'type' => Types::string(),
                    'description' => 'The unique identifier of a role in the platform. If user is null, this will be used to apply the collection preset or bookmark for all users in the role.',
                ],
                'search_query' => [
                    'type' => Types::string(),
                    'description' => 'What the user searched for in search/filter in the header bar.',
                ],
                'filters' => [
                    'type' => Types::json(),
                    'description' => 'The filters that the user applied.',
                ],
                'view_type' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Name of the view type that is used.',
                ],
                'view_query' => [
                    'type' => Types::string(),
                    'description' => 'View query that\'s saved per view type. Controls what data is fetched on load. These follow the same format as the JS SDK parameters.',
                ],
                'view_options' => [
                    'type' => Types::json(),
                    'description' => 'Options of the views. The properties in here are controlled by the layout.',
                ],
                'translation' => [
                    'type' => Types::json(),
                    'description' => 'Key value pair of language-translation. Can be used to translate the bookmark title in multiple languages.',
                ],
                // TODO: relationships
            ]
        ]);
    }
}
