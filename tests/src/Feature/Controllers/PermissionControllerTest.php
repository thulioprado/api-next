<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

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

    /**
     * @var array
     */
    private $permission;

    /**
     * @var array
     */
    private $collection;

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

        $this->collection = directus()->collections()->create([
            'name' => 'hello',
            'hidden' => true,
            'single' => true,
            'icon' => 'potato',
            'note' => 'my note on this',
            'translation' => [
                'pt-BR' => 'Oi',
            ],
            'fields' => [
                [
                    'name' => 'id',
                    'type' => 'integer',
                    'datatype' => 'int',
                    'primary_key' => true,
                    'auto_increment' => true,
                    'interface' => 'text-field',
                    'options' => [
                        'monospace' => true,
                    ],
                ],
                [
                    'name' => 'message',
                    'type' => 'text',
                    'datatype' => 'string',
                    'interface' => 'text-field',
                    'length' => 50,
                ],
            ],
        ]);

        $this->role = directus()->roles()->create([
            'name' => 'Developer',
        ]);

        $this->permission = directus()->permissions()->create([
            'collection_id' => $this->collection['id'],
            'role_id' => $this->role['id'],
            'status' => 'active',
            'read_field_blacklist' => ['test'],
            'write_field_blacklist' => ['test', 'test2'],
        ]);
    }

    public function testListAll(): void
    {
        $permissions = $this->getJson('/directus/permissions')->assertResponse()->data();

        $this->assertCount(1, $permissions);
        $this->assertArraySubset($this->permission, $permissions[0]);
        $this->assertTrue($this->permission['collection']['id'] === $this->collection['id']);
        $this->assertTrue($this->permission['role']['id'] === $this->role['id']);
    }

    public function testFetch(): void
    {
        $permission = $this->getJson("/directus/permissions/{$this->permission['id']}")->assertResponse()->data();
        $this->assertArraySubset($this->permission, $permission);
    }

    public function testCreateRole(): void
    {
        $this->postJson('/directus/permissions', [
            'collection_id' => $this->collection['id'],
            'role_id' => $this->role['id'],
            'read_field_blacklist' => ['create'],
        ])->assertResponse();

        $this->assertDatabaseHas('directus_permissions', [
            'collection_id' => $this->collection['id'],
            'role_id' => $this->role['id'],
            'read_field_blacklist' => json_encode(['create']),
        ]);
    }

    public function testUpdateRole(): void
    {
        $this->patchJson("/directus/permissions/{$this->permission['id']}", [
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
        $this->deleteJson("/directus/permissions/{$this->permission['id']}")->assertStatus(204);

        $this->assertCount(0, $this->getJson('/directus/permissions')->assertResponse()->data());
    }
}
