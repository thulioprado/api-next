<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\Models\Role;
use Directus\Exceptions\RoleNotCreated;
use Directus\Exceptions\RoleNotFound;
use Directus\Requests\RoleRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Role controller.
 */
class RoleController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Collection $roles */
        $roles = Role::with(['users', 'collectionPresets', 'permissions'])->get();

        return directus()->respond()->with($roles->toArray());
    }

    /**
     * @throws RoleNotFound
     */
    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Role $role */
        $role = Role::with(['users', 'collectionPresets', 'permissions'])->findOrFail($key);

        return directus()->respond()->with($role->toArray());
    }

    /**
     * @throws RoleNotCreated|RoleNotFound
     */
    public function create(RoleRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $role_id = directus()->databases()->system()->transaction(function () use ($attributes): string {
            /** @var Role $role */
            $role = new Role($attributes);
            $role->saveOrFail();

            return $role->id;
        });

        /** @var Role $role */
        $role = Role::with(['users', 'collectionPresets', 'permissions'])->findOrFail($role_id);

        return directus()->respond()->with($role->toArray());
    }

    /**
     * @throws RoleNotfound
     */
    public function update(string $key, RoleRequest $request): JsonResponse
    {
        /** @var Role $role */
        $role = Role::with(['users', 'collectionPresets', 'permissions'])->findOrFail($key);
        $role->update($request->all());

        return directus()->respond()->with($role->toArray());
    }

    /**
     * @throws RoleNotfound
     */
    public function delete(string $key): JsonResponse
    {
        /** @var Role $role */
        $role = Role::findOrFail($key);
        $role->delete();

        return directus()->respond()->withNothing();
    }
}
