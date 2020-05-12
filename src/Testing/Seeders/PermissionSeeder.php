<?php

declare(strict_types=1);

namespace Directus\Testing\Seeders;

use Directus\Contracts\Database\Seeder;
use Directus\Database\Models\Collection;
use Directus\Database\Models\Permission;
use Directus\Database\Models\Role;

class PermissionSeeder implements Seeder
{
    public function run(): void
    {
        /** @var Collection $collection */
        $collection = Collection::where('name', 'authors')->first();

        /** @var Role $role */
        $role = Role::where('name', 'User')->first();

        $permission = new Permission([
            'status' => 'active',
            'read_field_blacklist' => ['test'],
            'write_field_blacklist' => ['test', 'test2'],
            'collection_id' => $collection->id,
            'role_id' => $role->id,
        ]);
        $permission->save();
    }
}
