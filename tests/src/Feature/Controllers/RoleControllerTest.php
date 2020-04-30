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

    /**
     * @var array
     */
    private $role;

    /**
     * Set up.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $role = new Role([
            'name' => 'Developer',
        ]);

        $role->saveOrFail();

        $this->role = $role->toArray();
    }

    public function testListAll(): void
    {
        $roles = $this->getJson('/directus/roles')->assertResponse()->data();

        $this->assertCount(1, $roles);

        try {
            self::assertArraySubset($this->role, $roles[0]);
        } catch (\Throwable $t) {
        }
    }

    public function testFetch(): void
    {
        $role = $this->getJson("/directus/roles/{$this->role['id']}")->assertResponse()->data();

        try {
            self::assertArraySubset($this->role, $role);
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
        $this->patchJson("/directus/roles/{$this->role['id']}", [
            'name' => 'Designer',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_roles', [
            'name' => 'Designer',
        ]);
    }

    public function testDeleteRole(): void
    {
        $this->deleteJson("/directus/roles/{$this->role['id']}")->assertStatus(204);

        $this->assertCount(0, $this->getJson('/directus/roles')->assertResponse()->data());
    }
}
