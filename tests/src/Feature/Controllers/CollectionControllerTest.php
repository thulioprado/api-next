<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

/**
 * @covers \Directus\Controllers\CollectionController
 *
 * @internal
 */
final class CollectionControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testAllResponseFormat(): void
    {
        $collections = $this->getJson('/directus/collections');
        $collections->assertResponseStructure([
            '*' => [
                'id',
                'name',
                'note',
                'hidden',
                'single',
                'fields',
                'icon',
                'translation',
            ],
        ]);
    }

    public function testFetchSingleCollection(): void
    {
        $collections = $this->getJson('/directus/collections/posts');
        $collections->assertResponseHas([
            'name' => 'posts',
            'collection' => 'posts',
        ]);
    }

    public function testUpdateCollection(): void
    {
        $collection = $this->getJson('/directus/collections')->data()[0];

        $update = $this->patchJson("/directus/collections/{$collection['id']}", [
            'note' => 'alo',
        ]);

        $update->assertResponseHas([
            'note' => 'alo',
        ]);

        $this->assertDatabaseHas('directus_collections', [
            'id' => $collection['id'],
            'note' => 'alo',
        ]);
    }

    public function testCreateCollection(): void
    {
        $collections = $this->postJson('/directus/collections', [
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
        ])->assertResponse()->data();

        $this->assertDatabaseHas('directus_collections', [
            'id' => $collections['id'],
            'name' => 'hello',
            'system' => '0',
            'hidden' => '1',
            'single' => '1',
            'icon' => 'potato',
            'note' => 'my note on this',
            'translation' => '{"pt-BR":"Oi"}',
        ]);

        $this->assertDatabaseHas('directus_fields', [
            'name' => 'id',
            'collection_id' => $collections['id'],
        ]);

        $this->assertDatabaseHas('directus_fields', [
            'name' => 'message',
            'collection_id' => $collections['id'],
        ]);

        /*
        DB::insert("INSERT INTO hello (message) VALUES ('HELLO')");
        DB::insert("INSERT INTO hello (message) VALUES ('WORLD')");

        $this->assertDatabaseHas('hello', [
            'id' => '1',
            'message' => 'HELLO',
        ]);

        $this->assertDatabaseHas('hello', [
            'id' => '2',
            'message' => 'WORLD',
        ]);
        */
    }
}
