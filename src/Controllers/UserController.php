<?php

declare(strict_types=1);

namespace Directus\Controllers;

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
        // TODO: validate role, avatar and external when both services are implemented

        $input = request()->validate([
            'status' => 'required|string',
            //'role' => 'required|...',
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
        // TODO: validate role, avatar and external when both services are implemented

        $input = request()->validate([
            'status' => 'required|string',
            //'role' => 'required|...',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:'.User::class.',email,'.$key,
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
            directus()->users()->update($key, $input)
        );
    }

    public function delete(string $key): JsonResponse
    {
        directus()->users()->delete($key);

        return directus()->respond()->withNothing();
    }
}
