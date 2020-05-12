<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Controllers\RevisionController
 *
 * @internal
 */
final class RevisionControllerTest extends TestCase
{
    use DatabaseTransactions;
    use ArraySubsetAsserts;

    public function testListAll(): void
    {
        // TODO: test
        $revisions = $this->getJson('/directus/revisions')->assertResponse()->data();

        $this->assertCount(0, $revisions);
    }

    public function testFetch(): void
    {
        // TODO: test
        $this->getJson('/directus/revisions/1')->assertStatus(404);
    }
}
