<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\GraphQL\Schema;

use Directus\GraphQL\Schema\Source;
use Directus\Testing\TestCase;

/**
 * @covers \Directus\GraphQL\Schema\Source
 *
 * @internal
 */
final class SourceTest extends TestCase
{
    public function testLoadSimple(): void
    {
        $local = $this->getDataFilesystem('graphql');

        $loader = new Source($local);
        $source = $loader->load('simple/schema.graphql');

        static::assertStringContainsString('type Query', $source);
    }

    public function testLoadWildcard(): void
    {
        $local = $this->getDataFilesystem('graphql');

        $loader = new Source($local);
        $source = $loader->load('blog/schema.graphql');

        static::assertStringContainsString('type Query', $source);
        static::assertStringContainsString('type Post', $source);
        static::assertStringContainsString('type Author', $source);
    }

    public function testLoadWildcardInvalid(): void
    {
        $local = $this->getDataFilesystem('graphql');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Wildcards in folder names are not supported.');

        $loader = new Source($local);
        $loader->load('invalid/schema.graphql');
    }

    public function testLoadCallback(): void
    {
        $local = $this->getDataFilesystem('graphql');

        $loader = new Source($local);
        $source = $loader->load('simple/schema.graphql', static function ($source): string {
            return strrev($source);
        });

        static::assertStringContainsString('yreuQ epyt', $source);
    }
}
