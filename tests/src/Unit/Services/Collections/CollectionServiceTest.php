<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\Services\Collections;

use Directus\Exceptions\CollectionNotFound;
use Directus\Services\Collections\CollectionsService;
use Directus\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

/**
 * @covers \Directus\Services\Collections\CollectionsService
 *
 * @internal
 */
final class CollectionServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var CollectionsService
     */
    private $collections;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collections = directus()->collections();
    }

    public function testAllReturnsAllRecords(): void
    {
        $all = $this->collections->all();
        static::assertCount(DB::table('directus_collections')->count(), $all);
    }

    public function testCanFetchCollectionByNameOrId(): void
    {
        $activities1 = $this->collections->find('directus_activities');
        $activities2 = $this->collections->find('c5e7edfd-f7e8-42b5-8da3-a433d3c7822b');

        static::assertSame($activities1, $activities2);
    }

    public function testShouldThrowIfNotFound(): void
    {
        $this->expectException(CollectionNotFound::class);
        $this->collections->find('directus_woops');
    }
}
