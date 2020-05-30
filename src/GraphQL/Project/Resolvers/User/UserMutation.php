<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project\Resolvers\User;

use Directus\Database\Models\User;
use Illuminate\Support\Arr;

trait UserMutation
{
    /**
     * Resolves the createUser field.
     *
     * @param mixed $root
     */
    public static function resolveCreateUser($root, array $arguments): array
    {
        $user = new User($arguments);
        $user->saveOrFail();

        return $user->toArray();
    }

    /**
     * Resolves the updateUser field.
     *
     * @param mixed $root
     */
    public static function resolveUpdateUser($root, array $arguments): array
    {
        $key = Arr::get($arguments, 'key');

        $user = User::findOrFail($key);
        $user->role_id = Arr::get($arguments, 'role_id', $user->role_id);
        $user->status = Arr::get($arguments, 'status', $user->status);
        $user->first_name = Arr::get($arguments, 'first_name', $user->first_name);
        $user->last_name = Arr::get($arguments, 'last_name', $user->last_name);
        $user->email = Arr::get($arguments, 'email', $user->email);
        $user->password = Arr::get($arguments, 'password', $user->password);
        $user->token = Arr::get($arguments, 'token', $user->token);
        $user->timezone = Arr::get($arguments, 'timezone', $user->timezone);
        $user->locale = Arr::get($arguments, 'locale', $user->locale);
        $user->locale_options = Arr::get($arguments, 'locale_options', $user->locale_options);
        $user->avatar_id = Arr::get($arguments, 'avatar_id', $user->avatar_id);
        $user->company = Arr::get($arguments, 'company', $user->company);
        $user->title = Arr::get($arguments, 'title', $user->title);
        $user->email_notifications = Arr::get($arguments, 'email_notifications', $user->email_notifications);
        $user->last_access_on = Arr::get($arguments, 'last_access_on', $user->last_access_on);
        $user->last_page = Arr::get($arguments, 'last_page', $user->last_page);
        $user->external_id = Arr::get($arguments, 'external_id', $user->external_id);
        $user->theme = Arr::get($arguments, 'theme', $user->theme);
        $user->twofactor_secret = Arr::get($arguments, 'twofactor_secret', $user->twofactor_secret);
        $user->password_reset_token = Arr::get($arguments, 'password_reset_token', $user->password_reset_token);
        $user->saveOrFail();

        return $user->toArray();
    }

    /**
     * Resolves the deleteUser field.
     *
     * @param mixed $root
     */
    public static function resolveDeleteUser($root, array $arguments): array
    {
        $user = User::findOrFail(Arr::get($arguments, 'key'));
        $user->delete();

        return $user->toArray();
    }
}
