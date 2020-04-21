<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Controllers\PresetController
 *
 * @internal
 */
final class PresetControllerTest extends TestCase
{
    use DatabaseTransactions;
    use ArraySubsetAsserts;

    /**
     * @var array
     */
    private $preset;

    /**
     * Set up.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->preset = directus()->presets()->create('directus_users', [
            'title' => 'preset title',
            'search_query' => 'my query',
        ]);

        unset(
            $this->preset['user_id'],
            $this->preset['collection_id'],
            $this->preset['role_id']
        );
    }

    public function testListAll(): void
    {
        $presets = $this->getJson('/directus/collection_presets')->assertResponse()->data();
        static::assertCount(1, $presets);

        static::assertArraySubset($this->preset, $presets[0]);
    }

    public function testFetch(): void
    {
        $preset = $this->getJson("/directus/collection_presets/{$this->preset['id']}")->assertResponse()->data();
        static::assertArraySubset($this->preset, $preset);
    }

    public function testCreatePreset(): void
    {
        $this->postJson('/directus/collection_presets', [
            'collection' => 'directus_users',
            'title' => 'some random preset',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_collection_presets', [
            'title' => 'some random preset',
        ]);
    }

    public function testUpdatePreset(): void
    {
        $this->patchJson("/directus/collection_presets/{$this->preset['id']}", [
            'collection' => 'directus_users',
            'title' => 'my updated title',
        ])->assertResponse();

        $this->assertDatabaseHas('directus_collection_presets', [
            'title' => 'my updated title',
        ]);
    }

    public function testDeletePreset(): void
    {
        $this->deleteJson("/directus/collection_presets/{$this->preset['id']}")->assertStatus(204);

        static::assertCount(0, $this->getJson('/directus/collection_presets')->assertResponse()->data());
    }
}
