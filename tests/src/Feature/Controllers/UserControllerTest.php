<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Database\Models\Role;
use Directus\Database\Models\User;
use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;

/**
 * @covers \Directus\Controllers\UserController
 *
 * @internal
 */
final class UserControllerTest extends TestCase
{
    use DatabaseTransactions;
    use ArraySubsetAsserts;

    /**
     * @var array
     */
    private $user;

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

        $user = new User([
            'status' => 'active',
            'first_name' => 'thulio',
            'last_name' => 'prado',
            'email' => 'thulioprado@gmail.com',
            'password' => 'directus',
        ]);

        $user->role()->associate($role);
        $user->saveOrFail();

        $user = User::with(['role'])->findOrFail($user->id);

        $this->role = $role->toArray();
        $this->user = $user->toArray();
    }

    public function testListAll(): void
    {
        $users = $this->getJson('/directus/users')->assertResponse()->data();

        $this->assertCount(1, $users);

        try {
            self::assertArraySubset($this->user, $users[0]);
        } catch (\Throwable $t) {
        }
    }

    public function testFetch(): void
    {
        $user = $this->getJson("/directus/users/{$this->user['id']}")->assertResponse()->data();

        try {
            self::assertArraySubset($this->user, $user);
        } catch (\Throwable $t) {
        }

        $this->assertSame($this->role['id'], $user['role']['id']);
        $this->assertTrue(Hash::check('directus', $this->user['password']));
    }

    public function testCreateUser(): void
    {
        $this->postJson('/directus/users', [
            'status' => 'active',
            'role_id' => $this->role['id'],
            'first_name' => 'directus',
            'last_name' => 'test',
            'email' => 'test@directus.com',
            'password' => 'test',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_users', [
            'role_id' => $this->role['id'],
            'email' => 'test@directus.com',
        ]);
    }

    public function testUpdateUser(): void
    {
        $this->patchJson("/directus/users/{$this->user['id']}", [
            'status' => 'blocked',
            'email' => 'thulioprado@gmail.com',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_users', [
            'status' => 'blocked',
            'email' => 'thulioprado@gmail.com',
        ]);
    }

    public function testDeleteUser(): void
    {
        $this->deleteJson("/directus/users/{$this->user['id']}")->assertStatus(204);

        $this->assertCount(0, $this->getJson('/directus/users')->assertResponse()->data());
    }

    public function testInviteUser(): void
    {
        $this->postJson('/directus/users/invite', [
            'email' => 'wolfulus@gmail.com',
        ])->assertResponse();

        $this->postJson('/directus/users/invite', [
            'email' => 'wolfulus@gmail.com',
        ])->assertStatus(422)->assertJsonValidationErrors(['email']);

        $this->assertDatabaseHas('directus_users', [
            'email' => 'wolfulus@gmail.com',
            'status' => 'invited',
        ]);
    }

    // TODO: testAcceptInviteUser

    public function testTrackingPage(): void
    {
        $this->patchJson("/directus/users/{$this->user['id']}/tracking/page", [
            'last_page' => '/thumper/setting/',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_users', [
            'id' => $this->user['id'],
            'last_page' => '/thumper/setting/',
        ]);
    }

    // TODO: testListUserRevision
    // TODO: testUserRevision
}
