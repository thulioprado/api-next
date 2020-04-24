<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

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

        $this->role = directus()->roles()->create([
            'name' => 'Developer',
        ]);

        $this->user = directus()->users()->create([
            'status' => 'active',
            'role_id' => $this->role['id'],
            'first_name' => 'thulio',
            'last_name' => 'prado',
            'email' => 'thulioprado@gmail.com',
            'password' => 'directus',
        ]);
    }

    public function testListAll(): void
    {
        $users = $this->getJson('/directus/users')->assertResponse()->data();

        $this->assertCount(1, $users);
        $this->assertArraySubset($this->user, $users[0]);
    }

    public function testFetch(): void
    {
        $user = $this->getJson("/directus/users/{$this->user['id']}")->assertResponse()->data();

        $this->assertArraySubset($this->user, $user);
        $this->assertTrue($this->role['id'] === $user['role']['id']);
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
