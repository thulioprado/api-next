<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Controllers\ActivityController
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

        $this->role = directus()->roles()->create([
            'name' => 'Developer',
        ]);
    }

    public function testListAll(): void
    {
        $roles = $this->getJson('/directus/roles')->assertResponse()->data();

        static::assertCount(1, $roles);
        static::assertArraySubset($this->role, $roles[0]);
    }

    public function testFetch(): void
    {
        $role = $this->getJson("/directus/roles/{$this->role['id']}")->assertResponse()->data();
        static::assertArraySubset($this->role, $role);
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

        static::assertCount(0, $this->getJson('/directus/roles')->assertResponse()->data());
    }
}
