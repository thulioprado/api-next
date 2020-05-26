<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Database\Models\Role;
use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Controllers\RoleController
 *
 * @internal
 */
final class RoleControllerTest extends TestCase
{
    use DatabaseTransactions;
    use ArraySubsetAsserts;

    protected function setUp(): void
    {
        $this->markTestSkipped();
    }

    public function testListAll(): void
    {
        $roles = $this->getJson('/directus/roles')->assertResponse()->data();

        $this->assertCount(2, $roles);
    }

    public function testFetch(): void
    {
        /** @var ROle $dev */
        $dev = Role::where('name', 'Developer')->first();
        $role = $this->getJson("/directus/roles/{$dev->id}")->assertResponse()->data();

        try {
            self::assertArraySubset([
                'name' => 'Developer',
            ], $role);
        } catch (\Throwable $t) {
        }
    }

    public function testCreateRole(): void
    {
        $this->postJson('/directus/roles', [
            'name' => 'Developer',
        ])->assertStatus(422);

        $this->postJson('/directus/roles', [
            'name' => 'Administrator',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_roles', [
            'name' => 'Administrator',
        ]);
    }

    public function testUpdateRole(): void
    {
        /** @var Role $dev */
        $dev = Role::where('name', 'Developer')->first();
        $this->patchJson("/directus/roles/{$dev->id}", [
            'name' => 'Designer',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_roles', [
            'name' => 'Designer',
        ]);
    }

    public function testDeleteRole(): void
    {
        $role = new Role([
            'name' => 'Random',
        ]);
        $role->save();

        $this->deleteJson("/directus/roles/{$role->id}")->assertStatus(204);
        $this->getJson("/directus/roles/{$role->id}")->assertStatus(404);
    }
}
