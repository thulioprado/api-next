<?php

declare(strict_types=1);

namespace Directus\Services\Roles;

use Directus\Contracts\Services\Service;
use Directus\Database\System\Models\Role;
use Directus\Exceptions\RoleNotFound;

class RolesService implements Service
{
    public function all(): array
    {
        return Role::all()->toArray();
    }

    /**
     * @throws RoleNotFound
     */
    public function find(string $key): array
    {
        return $this->findModel($key)->toArray();
    }

    public function create(array $attributes): array
    {
        $role = new Role();

        // TODO: associate external when service are implemented
        //       // $role->external_id = data_get($attributes, 'external_id', null);

        $role->name = data_get($attributes, 'name');
        $role->description = data_get($attributes, 'description', null);
        $role->module_listing = data_get($attributes, 'module_listing', null);
        $role->collection_listing = data_get($attributes, 'collection_listing', null);
        $role->ip_whitelist = data_get($attributes, 'ip_whitelist', null);

        if (isset($attributes['enforce_2fa'])) {
            $role->enforce_2fa = data_get($attributes, 'enforce_2fa');
        }

        $role->save();

        return $role->toArray();
    }

    /**
     * @throws RoleNotFound
     */
    public function update(string $key, array $attributes): array
    {
        $role = $this->findModel($key);
        $role->update($attributes);

        return $role->toArray();
    }

    /**
     * @throws RoleNotFound
     */
    public function delete(string $key): void
    {
        $role = $this->findModel($key);
        $role->delete();
    }

    private function findModel(string $key): Role
    {
        $role = Role::find($key);

        if ($role === null) {
            throw new RoleNotFound($key);
        }

        return $role;
    }
}
