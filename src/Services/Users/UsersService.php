<?php

declare(strict_types=1);

namespace Directus\Services\Users;

use Directus\Contracts\Services\Service;
use Directus\Database\System\Models\User;
use Directus\Exceptions\UserNotFound;

class UsersService implements Service
{
    public function all(): array
    {
        return User::all()->toArray();
    }

    /**
     * @throws UserNotFound
     */
    public function find(string $key): array
    {
        return $this->findModel($key)->toArray();
    }

    public function create(array $attributes): array
    {
        $user = new User();

        // TODO: associate role, avatar and external when both services are implemented
        //       // $user->role_id = data_get($attributes, 'role', null);
        //       // $user->avatar_id = data_get($attributes, 'avatar', null);
        //       // $user->external_id = data_get($attributes, 'external_id', null);

        $user->first_name = data_get($attributes, 'first_name', null);
        $user->last_name = data_get($attributes, 'last_name', null);
        $user->email = data_get($attributes, 'email');
        $user->password = data_get($attributes, 'password');
        $user->last_access_on = data_get($attributes, 'last_access_on', null);
        $user->last_page = data_get($attributes, 'last_page', null);
        $user->password_reset_token = data_get($attributes, 'password_reset_token', null);
        $user->locale = data_get($attributes, 'locale', null);
        $user->locale_options = data_get($attributes, 'locale_options', null);
        $user->company = data_get($attributes, 'company', null);
        $user->title = data_get($attributes, 'title', null);
        $user->twofactor_secret = data_get($attributes, '2fa_secret', null);

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

        $user->save();

        return $user->toArray();
    }

    /**
     * @throws UserNotFound
     */
    public function update(string $key, array $attributes): array
    {
        if (isset($attributes['2fa_secret'])) {
            $attributes['twofactor_secret'] = $attributes['2fa_secret'];
            unset($attributes['2fa_secret']);
        }

        $user = $this->findModel($key);
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
        $user = User::find($key);

        if ($user === null) {
            throw new UserNotFound($key);
        }

        return $user;
    }
}
