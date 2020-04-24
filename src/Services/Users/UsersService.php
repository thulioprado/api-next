<?php

declare(strict_types=1);

namespace Directus\Services\Users;

use Directus\Contracts\Services\Service;
use Directus\Database\System\Models\Role;
use Directus\Database\System\Models\User;
use Directus\Exceptions\RoleNotFound;
use Directus\Exceptions\UserNotFound;

class UsersService implements Service
{
    public function all(): array
    {
        return User::with('role')->get()->toArray();
    }

    /**
     * @throws UserNotFound
     */
    public function find(string $key): array
    {
        return $this->findModel($key)->toArray();
    }

    /**
     * @throws RoleNotFound
     */
    public function create(array $attributes): array
    {
        $user = new User();

        // TODO: associate avatar and external when both services are implemented
        //       // $user->avatar_id = data_get($attributes, 'avatar');
        //       // $user->external_id = data_get($attributes, 'external_id');

        $user->first_name = data_get($attributes, 'first_name');
        $user->last_name = data_get($attributes, 'last_name');
        $user->email = data_get($attributes, 'email');
        $user->password = data_get($attributes, 'password');
        $user->last_access_on = data_get($attributes, 'last_access_on');
        $user->last_page = data_get($attributes, 'last_page');
        $user->password_reset_token = data_get($attributes, 'password_reset_token');
        $user->locale = data_get($attributes, 'locale');
        $user->locale_options = data_get($attributes, 'locale_options');
        $user->company = data_get($attributes, 'company');
        $user->title = data_get($attributes, 'title');
        $user->twofactor_secret = data_get($attributes, 'twofactor_secret');

        if (isset($attributes['status'])) {
            $user->status = data_get($attributes, 'status');
        }

        if (isset($attributes['theme'])) {
            $user->theme = data_get($attributes, 'theme');
        }

        if (isset($attributes['timezone'])) {
            $user->timezone = data_get($attributes, 'timezone');
        }

        if (isset($attributes['email_notifications'])) {
            $user->email_notifications = data_get($attributes, 'email_notifications');
        }

        if (isset($attributes['role_id'])) {
            $role = $this->findRole(data_get($attributes, 'role_id'));
            $user->role()->associate($role);
        }

        $user->save();

        return $user->toArray();
    }

    /**
     * @throws RoleNotFound|UserNotFound
     */
    public function update(string $key, array $attributes): array
    {
        $user = $this->findModel($key);

        if (isset($attributes['role_id'])) {
            $role_id = data_get($attributes, 'role_id');

            if ($user->role_id !== $role_id) {
                $role = $this->findRole($role_id);
                $user->role()->associate($role);
            }

            unset($attributes['role_id']);
        }

        $user->update($attributes);

        return $user->toArray();
    }

    /**
     * @throws UserNotFound
     */
    public function delete(string $key): void
    {
        $user = $this->findModel($key);
        $user->delete();
    }

    private function findModel(string $key): User
    {
        $user = User::with('role')->find($key);

        if ($user === null) {
            throw new UserNotFound($key);
        }

        return $user;
    }

    private function findRole(string $key): Role
    {
        $role = Role::find($key);

        if ($role === null) {
            throw new RoleNotFound($key);
        }

        return $role;
    }
}
