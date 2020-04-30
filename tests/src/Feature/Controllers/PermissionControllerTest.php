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

        $collection = new Collection([
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

        $collection->save(); // TODO: change to saveOrFail when collection model is updated.

        $role = new Role([
            'name' => 'Developer',
        ]);

        $role->saveOrFail();

        $permission = new Permission([
            'status' => 'active',
            'read_field_blacklist' => ['test'],
            'write_field_blacklist' => ['test', 'test2'],
        ]);

        $permission->collection()->associate($collection);
        $permission->role()->associate($role);
        $permission->saveOrFail();

        $this->collection = $collection->toArray();
        $this->role = $role->toArray();
        $this->permission = $permission->toArray();
    }

    public function testListAll(): void
    {
        $permissions = $this->getJson('/directus/permissions')->assertResponse()->data();

        $this->assertCount(1, $permissions);

        try {
            self::assertArraySubset($this->permission, $permissions[0]);
        } catch (\Throwable $t) {
        }

        $this->assertSame($this->permission['collection']['id'], $this->collection['id']);
        $this->assertSame($this->permission['role']['id'], $this->role['id']);
    }

    public function testFetch(): void
    {
        $permission = $this->getJson("/directus/permissions/{$this->permission['id']}")->assertResponse()->data();

        try {
            self::assertArraySubset($this->permission, $permission);
        } catch (\Throwable $t) {
        }
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
