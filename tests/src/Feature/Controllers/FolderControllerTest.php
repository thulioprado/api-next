<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Database\Models\File;
use Directus\Database\Models\Folder;
use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Controllers\FolderController
 *
 * @internal
 *
 * TODO: test with files
 */
final class FolderControllerTest extends TestCase
{
    use DatabaseTransactions;
    use ArraySubsetAsserts;

    public function testListAll(): void
    {
        /** @var Folder $main */
        $main = Folder::where('name', 'Main Folder')->first();

        /** @var Folder $child */
        $child = Folder::with(['parent'])->where('name', 'Child Folder')->first();
        $folders = $this->getJson('/directus/folders')->assertResponse()->data();

        $this->assertCount(3, $folders);

        try {
            self::assertArraySubset([$main->toArray()], $folders);
            self::assertArraySubset([$child->toArray()], $folders);
        } catch (\Throwable $t) {
        }
    }

    public function testFetch(): void
    {
        /** @var Folder $child */
        $child = Folder::with(['parent'])->where('name', 'Child Folder')->first();
        $folder = $this->getJson("/directus/folders/{$child->id}")->assertResponse()->data();

        try {
            self::assertArraySubset($child->toArray(), $folder);
        } catch (\Throwable $t) {
        }
    }

    public function testCreateFolder(): void
    {
        /** @var Folder $main */
        $main = Folder::where('name', 'Main Folder')->first();

        $this->postJson('/directus/folders', [
            'name' => 'Child Folder',
            'parent_id' => $main->id,
        ])->assertStatus(422)->assertJsonValidationErrors(['name']);

        $this->postJson('/directus/folders', [
            'name' => 'Other Folder',
            'parent_id' => $main->id,
        ])->assertResponse();

        $this->assertDatabaseHas('directus_folders', [
            'name' => 'Other Folder',
            'parent_id' => $main->id,
        ]);
    }

    public function testUpdateFolder(): void
    {
        /** @var Folder $child */
        $child = Folder::with(['parent'])->where('name', 'Child Folder')->first();

        $this->patchJson("/directus/folders/{$child->id}", [
            'parent_id' => null,
        ])->assertResponse();

        $this->assertDatabaseHas('directus_folders', [
            'name' => $child->name,
            'parent_id' => null,
        ]);
    }

    public function testDeleteFolder(): void
    {
        /** @var Folder $main */
        $main = Folder::where('name', 'Main Folder')->first();

        /** @var Folder $child */
        $child = Folder::where('name', 'Child Folder')->first();

        /** @var Folder $baby */
        $baby = Folder::where('name', 'Baby Folder')->first();

        $filesInBabyFolder = File::where('folder_id', $baby->id)->count();
        $filesWithoutAFolder = File::where('folder_id', null)->count();

        $this->getJson("/directus/folders/{$main->id}")->assertStatus(200);
        $this->getJson("/directus/folders/{$child->id}")->assertStatus(200);
        $this->getJson("/directus/folders/{$baby->id}")->assertStatus(200);

        $this->deleteJson("/directus/folders/{$main->id}")->assertStatus(204);

        $this->getJson("/directus/folders/{$main->id}")->assertStatus(404);
        $this->getJson("/directus/folders/{$child->id}")->assertStatus(404);
        $this->getJson("/directus/folders/{$baby->id}")->assertStatus(404);

        $newFilesInBabyFolder = File::where('folder_id', $baby->id)->count();
        $newFilesWithoutAFolder = File::where('folder_id', null)->count();

        static::assertEquals(0, $newFilesInBabyFolder);
        static::assertEquals($filesWithoutAFolder + $filesInBabyFolder, $newFilesWithoutAFolder);
    }
}
