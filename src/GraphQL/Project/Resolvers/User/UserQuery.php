<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project\Resolvers\User;

use Directus\Database\Models\User;
use Illuminate\Support\Arr;

trait UserQuery
{
    /**
     * Resolves the settings field.
     *
     * @return mixed
     */
    public static function resolveUsers()
    {
        return User::all();
    }

    /**
     * Resolves the setting field.
     *
     * @param mixed $root
     */
    public static function resolveUser($root, array $arguments): array
    {
        return User::findOrFail(Arr::get($arguments, 'key'))->toArray();
    }
}
