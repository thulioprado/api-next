<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server\Types;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;
use Illuminate\Support\Str;

class ProjectType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Project',
            'description' => 'Directus project information.',
            'fields' => [
                'id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'The unique project ID.'
                ],
                'name' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'The project name.',
                    'resolve' => static function ($data) {
                        return $data['name'] ?? Str::title($data['id']);
                    },
                ],
            ],
        ]);
    }
}
