<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\Models\Permission;
use Directus\Exceptions\CollectionNotFound;
use Directus\Exceptions\PermissionNotCreated;
use Directus\Exceptions\PermissionNotFound;
use Directus\Exceptions\RoleNotFound;
use Directus\Requests\PermissionRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Permission controller.
 */
class PermissionController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Collection $permissions */
        $permissions = Permission::with(['collection', 'role'])->get();

        return directus()->respond()->with($permissions->toArray());
    }

    /**
     * @throws PermissionNotFound
     */
    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Permission $permission */
        $permission = Permission::with(['collection', 'role'])->findOrFail($key);

        return directus()->respond()->with($permission->toArray());
    }

    /**
     * @throws PermissionNotCreated|PermissionNotFound
     */
    public function create(PermissionRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $permission_id = directus()->databases()->system()->transaction(function () use ($attributes): string {
            /** @var Permission $permission */
            $permission = new Permission($attributes);
            $permission->saveOrFail();

            return $permission->id;
        });

        /** @var Permission $permission */
        $permission = Permission::with(['collection', 'role'])->findOrFail($permission_id);

        return directus()->respond()->with($permission->toArray());
    }

    /**
     * @throws CollectionNotFound|PermissionNotFound|RoleNotFound
     */
    public function update(string $key, PermissionRequest $request): JsonResponse
    {
        /** @var Permission $permission */
        $permission = Permission::with(['collection', 'role'])->findOrFail($key);
        $permission->update($request->all());

        return directus()->respond()->with($permission->toArray());
    }

    /**
     * @throws PermissionNotFound
     */
    public function delete(string $key): JsonResponse
    {
        /** @var Permission $permission */
        $permission = Permission::findOrFail($key);
        $permission->delete();

        return directus()->respond()->withNothing();
    }

    // TODO: Missing endpoints: List the current users permissions and
    // list the current users permissions for given collection
}
