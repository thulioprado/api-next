<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

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

        $this->folder = directus()->folders()->create([
            'name' => 'Main',
        ]);

        $this->child = directus()->folders()->create([
            'parent_folder' => $this->folder['id'],
            'name' => 'Child',
        ]);
    }

    public function testListAll(): void
    {
        $folders = $this->getJson('/directus/folders')->assertResponse()->data();

        $this->assertCount(2, $folders);
        $this->assertArraySubset($this->folder, $folders[0]);
    }

    public function testFetch(): void
    {
        $folder = $this->getJson("/directus/folders/{$this->folder['id']}")->assertResponse()->data();
        $this->assertArraySubset($this->folder, $folder);
    }

    public function testCreateFolder(): void
    {
        $this->postJson('/directus/folders', [
            'name' => 'Main',
        ])->assertStatus(422)->assertJsonValidationErrors(['name']);

        $this->postJson('/directus/folders', [
            'parent_folder' => $this->folder['id'],
            'name' => 'Child2',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_folders', [
            'parent_id' => $this->folder['id'],
            'name' => 'Child2',
        ]);
    }

    public function testUpdateFolder(): void
    {
        $this->patchJson("/directus/folders/{$this->child['id']}", [
            'name' => 'Main2',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_folders', [
            'parent_id' => null,
            'name' => 'Main2',
        ]);
    }

    public function testDeleteFolder(): void
    {
        $this->deleteJson("/directus/folders/{$this->folder['id']}")->assertStatus(204);

        $this->assertCount(0, $this->getJson('/directus/folders')->assertResponse()->data());
    }
}
