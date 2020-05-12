<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Database\Models\Collection;
use Directus\Database\Models\Permission;
use Directus\Database\Models\Role;
use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Controllers\PermissionController
 *
 * @internal
 */
final class PermissionControllerTest extends TestCase
{
    use DatabaseTransactions;
    use ArraySubsetAsserts;

    public function testListAll(): void
    {
        /** @var Collection $collection */
        $collection = Collection::where('name', 'authors')->first();

        /** @var Role $role */
        $role = Role::where('name', 'User')->first();

        /** @var Permission $permission */
        $permission = Permission::with(['collection', 'role'])->first();
        $permissions = $this->getJson('/directus/permissions')->assertResponse()->data();

        $this->assertCount(1, $permissions);

        try {
            self::assertArraySubset([$permission->toArray()], $permissions);
        } catch (\Throwable $t) {
        }
    }

    public function testFetch(): void
    {
        /** @var Permission $perm */
        $perm = Permission::with(['collection', 'role'])->first();
        $permission = $this->getJson("/directus/permissions/{$perm->id}")->assertResponse()->data();

        try {
            self::assertArraySubset($perm->toArray(), $permission);
        } catch (\Throwable $t) {
        }
    }

    public function testCreateRole(): void
    {
        /** @var Collection $collection */
        $collection = Collection::where('name', 'authors')->first();
        /** @var Role $role */
        $role = Role::where('name', 'User')->first();

        $this->postJson('/directus/permissions', [
            'collection_id' => $collection->id,
            'role_id' => $role->id,
            'read_field_blacklist' => ['create'],
        ])->assertResponse();

        $this->assertDatabaseHas('directus_permissions', [
            'collection_id' => $collection->id,
            'role_id' => $role->id,
            'read_field_blacklist' => json_encode(['create']),
        ]);
    }

    public function testUpdateRole(): void
    {
        /** @var Permission $permission */
        $permission = Permission::with(['collection', 'role'])->first();

        $this->patchJson("/directus/permissions/{$permission->id}", [
            'status' => 'inactive',
            'read_field_blacklist' => ['read test', 'test read'],
            'write_field_blacklist' => ['write test', 'test write'],
        ])->assertResponse();

        $this->assertDatabaseHas('directus_permissions', [
            'status' => 'inactive',
            'read_field_blacklist' => json_encode(['read test', 'test read']),
            'write_field_blacklist' => json_encode(['write test', 'test write']),
        ]);
    }

    public function testDeleteRole(): void
    {
        /** @var Permission $permission */
        $permission = Permission::with(['collection', 'role'])->first();

        $this->deleteJson("/directus/permissions/{$permission->id}")->assertStatus(204);
        $this->getJson("/directus/permissions/{$permission->id}")->assertStatus(404);
    }
}
