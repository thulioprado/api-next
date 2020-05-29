<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @covers \Directus\Controllers\CollectionController
 *
 * @internal
 */
final class GraphQLTest extends TestCase
{
    use DatabaseTransactions;

    /*public function testQuery(): void
    {
        $response = directus()->graphql()->execute(/** @lang GraphQL */ '
            query {
                server {
                    ping
                }
            }
        ');

        static::assertIsArray($response);
    }*/
}
