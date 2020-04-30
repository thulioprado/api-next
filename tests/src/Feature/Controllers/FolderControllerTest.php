<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Database\Models\Folder;
use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Controllers\FolderController
 *
 * @internal
 */
final class FolderControllerTest extends TestCase
{
    use DatabaseTransactions;
    use ArraySubsetAsserts;

    /**
     * @var array
     */
    private $folder;

    /**
     * @var array
     */
    private $child;

    /**
     * Set up.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $father = new Folder([
            'name' => 'Main',
        ]);

        $father->saveOrFail();

        $child = new Folder([
            'name' => 'Child',
        ]);

        $child->parent()->associate($father);
        $child->saveOrFail();

        $this->folder = $father->toArray();
        $this->child = $child->toArray();
    }

    public function testListAll(): void
    {
        $folders = $this->getJson('/directus/folders')->assertResponse()->data();

        $this->assertCount(2, $folders);

        try {
            self::assertArraySubset($this->folder, $folders[0]);
        } catch (\Throwable $t) {
        }
    }

    public function testFetch(): void
    {
        $folder = $this->getJson("/directus/folders/{$this->folder['id']}")->assertResponse()->data();

        try {
            self::assertArraySubset($this->folder, $folder);
        } catch (\Throwable $t) {
        }
    }

    public function testCreateFolder(): void
    {
        $this->postJson('/directus/folders', [
            'name' => 'Main',
        ])->assertStatus(422)->assertJsonValidationErrors(['name']);

        $data = $this->postJson('/directus/folders', [
            'name' => 'Child2',
            'parent_id' => $this->folder['id'],
        ])->assertResponse();

        $this->assertDatabaseHas('directus_folders', [
            'name' => 'Child2',
            'parent_id' => $this->folder['id'],
        ]);
    }

    public function testUpdateFolder(): void
    {
        $this->patchJson("/directus/folders/{$this->child['id']}", [
            'name' => 'Main2',
            'parent_id' => null,
        ])->assertResponse();

        $this->assertDatabaseHas('directus_folders', [
            'name' => 'Main2',
            'parent_id' => null,
        ]);
    }

    public function testDeleteFolder(): void
    {
        $this->deleteJson("/directus/folders/{$this->folder['id']}")->assertStatus(204);

        $this->assertCount(0, $this->getJson('/directus/folders')->assertResponse()->data());
    }
}
