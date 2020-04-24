<?php

declare(strict_types=1);

namespace Directus\Services\Permissions;

use Directus\Contracts\Services\Service;
use Directus\Database\System\Models\Collection;
use Directus\Database\System\Models\Permission;
use Directus\Database\System\Models\Role;
use Directus\Exceptions\CollectionNotFound;
use Directus\Exceptions\PermissionNotFound;
use Directus\Exceptions\RoleNotFound;

class PermissionsService implements Service
{
    public function all(): array
    {
        return Permission::with(['collection', 'role'])->get()->toArray();
    }

    /**
     * @throws PermissionNotFound
     */
    public function find(string $key): array
    {
        return $this->findModel($key)->toArray();
    }

    /**
     * @throws CollectionNotFound|RoleNotFound
     */
    public function create(array $attributes): array
    {
        $permission = new Permission();

        $permission->status = data_get($attributes, 'status', null);
        $permission->status_blacklist = data_get($attributes, 'status_blacklist', null);
        $permission->read_field_blacklist = data_get($attributes, 'read_field_blacklist', null);
        $permission->write_field_blacklist = data_get($attributes, 'write_field_blacklist', null);

        if (isset($attributes['create'])) {
            $permission->create = data_get($attributes, 'create');
        }

        if (isset($attributes['read'])) {
            $permission->read = data_get($attributes, 'read');
        }

        if (isset($attributes['update'])) {
            $permission->update = data_get($attributes, 'update');
        }

        if (isset($attributes['delete'])) {
            $permission->delete = data_get($attributes, 'delete');
        }

        if (isset($attributes['comment'])) {
            $permission->comment = data_get($attributes, 'comment');
        }

        if (isset($attributes['explain'])) {
            $permission->explain = data_get($attributes, 'explain');
        }

        if (isset($attributes['collection_id'])) {
            $collection = $this->findCollection(data_get($attributes, 'collection_id'));
            $permission->collection()->associate($collection);
        }

        if (isset($attributes['role_id'])) {
            $role = $this->findRole(data_get($attributes, 'role_id'));
            $permission->role()->associate($role);
        }

        $permission->save();

        return $permission->toArray();
    }

    /**
     * @throws CollectionNotFound|PermissionNotFound|RoleNotFound
     */
    public function update(string $key, array $attributes): array
    {
        $permission = $this->findModel($key);

        if (isset($attributes['collection_id'])) {
            $collection_id = data_get($attributes, 'collection_id');

            if ($permission->collection_id !== $collection_id) {
                $collection = $this->findCollection($collection_id);
                $permission->collection()->associate($collection);
            }

            unset($attributes['collection_id']);
        }

        if (isset($attributes['role_id'])) {
            $role_id = data_get($attributes, 'role_id');

            if ($permission->role_id !== $role_id) {
                $role = $this->findRole($role_id);
                $permission->role()->associate($role);
            }

            unset($attributes['role_id']);
        }

        $permission->update($attributes);

        return $permission->toArray();
    }

    /**
     * @throws PermissionNotFound
     */
    public function delete(string $key): void
    {
        $permission = $this->findModel($key);
        $permission->delete();
    }

    private function findModel(string $key): Permission
    {
        $permission = Permission::with(['collection', 'role'])->find($key);

        if ($permission === null) {
            throw new PermissionNotFound($key);
        }

        return $permission;
    }

    private function findCollection(string $key): Collection
    {
        $collection = Collection::find($key);

        if ($collection === null) {
            throw new CollectionNotFound($key);
        }

        return $collection;
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
