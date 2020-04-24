<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Carbon\Carbon;
use Directus\Database\System\Models\Role;
use Directus\Database\System\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * User controller.
 */
class UserController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->users()->all()
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->users()->find($key)
        );
    }

    public function create(): JsonResponse
    {
        // TODO: validate avatar and external when both services are implemented

        $input = request()->validate([
            'status' => 'required|string',
            'role_id' => 'required|exists:'.Role::class.',id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:'.User::class.',email',
            'password' => 'required|string',
            'last_access_on' => 'date|nullable',
            'last_page' => 'string|nullable',
            //'external_id' => 'string|nullable',
            'theme' => 'string|nullable',
            '2fa_secret' => 'string|nullable',
            'password_reset_token' => 'string|nullable',
            'timezone' => 'string|nullable',
            'locale' => 'string|nullable',
            'locale_options' => 'string|nullable',
            //'avatar' => 'string|nullable',
            'company' => 'string|nullable',
            'title' => 'string|nullable',
            'email_notifications' => 'boolean|nullable',
        ]);

        return directus()->respond()->with(
            directus()->users()->create($input)
        );
    }

    public function update(string $key): JsonResponse
    {
        // TODO: validate avatar and external when both services are implemented

        $input = request()->validate([
            'status' => 'string',
            'role_id' => 'exists:'.Role::class.',id',
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email|unique:'.User::class.',email,'.$key,
            'password' => 'string',
            'last_access_on' => 'date|nullable',
            'last_page' => 'string|nullable',
            //'external_id' => 'string|nullable',
            'theme' => 'string|nullable',
            '2fa_secret' => 'string|nullable',
            'password_reset_token' => 'string|nullable',
            'timezone' => 'string|nullable',
            'locale' => 'string|nullable',
            'locale_options' => 'string|nullable',
            //'avatar' => 'string|nullable',
            'company' => 'string|nullable',
            'title' => 'string|nullable',
            'email_notifications' => 'boolean|nullable',
        ]);

        return directus()->respond()->with(
            directus()->users()->update($key, $input)
        );
    }

    public function delete(string $key): JsonResponse
    {
        directus()->users()->delete($key);

        return directus()->respond()->withNothing();
    }

    // TODO: Missing https://docs.directus.io/api/users.html#retrieve-the-current-user

    public function invite(): JsonResponse
    {
        // TODO: validate avatar and external when both services are implemented

        $input = request()->validate([
            'email' => 'required|email|unique:'.User::class.',email',
        ]);

        return directus()->respond()->with(
            directus()->users()->create([
                'email' => data_get($input, 'email'),
                'status' => 'invited',
            ])
        );
    }

    public function acceptInvite(string $token): JsonResponse
    {
        // TODO
        return directus()->respond()->withNothing();
    }

    public function updateLastPage(string $key): JsonResponse
    {
        $input = request()->validate([
            'last_page' => 'required|string',
        ]);

        return directus()->respond()->with(
            directus()->users()->update($key, [
                'last_page' => data_get($input, 'last_page'),
                'last_access_on' => Carbon::now(),
            ])
        );
    }

    public function revision(string $key, string $offset = null): JsonResponse
    {
        // TODO
        return directus()->respond()->withNothing();
    }
}
