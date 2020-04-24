<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\System\Models\Collection;
use Directus\Database\System\Models\Permission;
use Directus\Database\System\Models\Role;
use Illuminate\Http\JsonResponse;

/**
 * Permission controller.
 */
class PermissionController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->permissions()->all()
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->permissions()->find($key)
        );
    }

    public function create(): JsonResponse
    {
        $input = request()->validate([
            'collection_id' => 'required|exists:'.Collection::class.',id',
            'role_id' => 'required|exists:'.Role::class.',id',
            'status' => 'string|nullable',
            'create' => 'string|nullable',
            'read' => 'string|nullable',
            'update' => 'string|nullable',
            'delete' => 'string|nullable',
            'comment' => 'string|nullable',
            'explain' => 'string|nullable',
            'read_field_blacklist' => 'array|nullable',
            'write_field_blacklist' => 'array|nullable',
            'status_blacklist' => 'array|nullable',
        ]);

        return directus()->respond()->with(
            directus()->permissions()->create($input)
        );
    }

    public function update(string $key): JsonResponse
    {
        $input = request()->validate([
            'collection_id' => 'exists:'.Collection::class.',id',
            'role_id' => 'exists:'.Role::class.',id',
            'status' => 'string|nullable',
            'create' => 'string|nullable',
            'read' => 'string|nullable',
            'update' => 'string|nullable',
            'delete' => 'string|nullable',
            'comment' => 'string|nullable',
            'explain' => 'string|nullable',
            'read_field_blacklist' => 'array|nullable',
            'write_field_blacklist' => 'array|nullable',
            'status_blacklist' => 'array|nullable',
        ]);

        return directus()->respond()->with(
            directus()->permissions()->update($key, $input)
        );
    }

    public function delete(string $key): JsonResponse
    {
        directus()->permissions()->delete($key);

        return directus()->respond()->withNothing();
    }

    // TODO: Missing endpoints: List the current users permissions and
    // list the current users permissions for given collection
}
