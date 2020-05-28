<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\GraphQL\Query;

use Directus\Testing\TestCase;

/**
 * @covers \Directus\GraphQL\Query\QueryBuilder
 *
 * @internal
 */
final class BuilderTest extends TestCase
{
    public function testErrorFor(): void
    {
        $server = directus()->graphql()->server();
        $sum = $server->mutation('sum')->as('value')->execute([
            'param1' => 10,
            'param2' => 5,
        ]);

        static::assertEquals(15, $sum->data['value']);
    }
}
