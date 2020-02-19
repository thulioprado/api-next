<?php

declare(strict_types=1);

namespace Directus\Tests\Core\Projects\Repositories\Providers;

use Directus\Core\Projects\Repositories\DirectoryProvider;
use Directus\Tests\Helpers\DirectusTestCase;

/**
 * @internal
 * @coversNothing
 */
final class DirectoryProviderTest extends DirectusTestCase
{
    /**
     * Some example usage.
     *
     * @covers \DirectoryProvider::exists
     */
    public function testExists(): void
    {
        $repository = new DirectoryProvider([
            'path' => $this->getDataFilePath('config/projects'),
        ]);

        static::assertTrue($repository->exists('project1'));
        static::assertTrue($repository->exists('project2'));
        static::assertFalse($repository->exists('project3'));
    }
}
