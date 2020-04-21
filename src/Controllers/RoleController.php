<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\System\Models\Role;
use Illuminate\Http\JsonResponse;

/**
 * Role controller.
 */
class RoleController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->roles()->all()
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->roles()->find($key)
        );
    }

    public function create(): JsonResponse
    {
        // TODO: validate external when service are implemented

        $input = request()->validate([
            'name' => 'required|string|unique:'.Role::class.',name',
            'description' => 'string|nullable',
            'ip_whitelist' => 'array|nullable',
            //'external_id' => 'string|nullable',
            'module_listing' => 'array|nullable',
            'collection_listing' => 'array|nullable',
            'enforce_2fa' => 'boolean|nullable',
        ]);

        return directus()->respond()->with(
            directus()->roles()->create($input)
        );
    }

    public function update(string $key): JsonResponse
    {
        // TODO: validate external when service are implemented

        $input = request()->validate([
            'name' => 'required|string|unique:'.Role::class.',name,'.$key,
            'description' => 'string|nullable',
            'ip_whitelist' => 'array|nullable',
            //'external_id' => 'string|nullable',
            'module_listing' => 'array|nullable',
            'collection_listing' => 'array|nullable',
            'enforce_2fa' => 'boolean|nullable',
        ]);

        return directus()->respond()->with(
            directus()->roles()->update($key, $input)
        );
    }

    public function delete(string $key): JsonResponse
    {
        directus()->roles()->delete($key);

        return directus()->respond()->withNothing();
    }
}
