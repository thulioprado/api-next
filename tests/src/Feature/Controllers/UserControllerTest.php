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
     * Set up.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = directus()->users()->create([
            'status' => 'active',
            'first_name' => 'thulio',
            'last_name' => 'prado',
            'email' => 'thulioprado@gmail.com',
            'password' => 'directus',
        ]);
    }

    public function testListAll(): void
    {
        $users = $this->getJson('/directus/users')->assertResponse()->data();

        static::assertCount(1, $users);
        static::assertArraySubset($this->user, $users[0]);
    }

    public function testFetch(): void
    {
        $user = $this->getJson("/directus/users/{$this->user['id']}")->assertResponse()->data();
        static::assertArraySubset($this->user, $user);

        $this->assertTrue(Hash::check('directus', $this->user['password']));
    }

    public function testCreateUser(): void
    {
        $this->postJson('/directus/users', [
            'status' => 'active',
            'first_name' => 'directus',
            'last_name' => 'test',
            'email' => 'test@directus.com',
            'password' => 'test',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_users', [
            'email' => 'test@directus.com',
        ]);
    }

    public function testUpdateUser(): void
    {
        $this->patchJson("/directus/users/{$this->user['id']}", [
            'status' => 'active',
            'first_name' => 'thulioprado',
            'last_name' => 'directus',
            'email' => 'thulioprado@gmail.com',
            'password' => 'directus',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_users', [
            'email' => 'thulioprado@gmail.com',
            'first_name' => 'thulioprado',
            'last_name' => 'directus',
        ]);
    }

    public function testDeleteUser(): void
    {
        $this->deleteJson("/directus/users/{$this->user['id']}")->assertStatus(204);

        static::assertCount(0, $this->getJson('/directus/users')->assertResponse()->data());
    }
}
