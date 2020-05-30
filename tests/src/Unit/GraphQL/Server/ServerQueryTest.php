<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\GraphQL\Server;

use Directus\Testing\TestCase;

/**
 * @covers \Directus\GraphQL\Query\QueryBuilder
 *
 * @internal
 */
final class ServerQueryTest extends TestCase
{
    public function testPing(): void
    {
        $server = directus()->graphql()->server();
        $result = $server->execute(/* @lang GraphQL */ '
            query {
                ping
            }
        ');

        static::assertEquals('pong', $result->data['ping']);
    }
}
