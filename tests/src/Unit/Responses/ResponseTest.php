<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\Responses;

use Directus\Responses\Response;
use Directus\Testing\TestCase;

/**
 * @covers \Directus\Responses\Response
 *
 * @internal
 */
final class ResponseTest extends TestCase
{
    public function testSuccessfulResponse(): void
    {
        $response = new Response();
        $response->with(['hello' => 'world']);
        static::assertArrayNotHasKey('error', $response->getData(true));
        static::assertSame($response->status(), 200);
        static::assertSame([
            'data' => [
                'hello' => 'world',
            ],
        ], $response->getData(true));
    }

    public function testSuccessfulResponseWithNothing(): void
    {
        $response = new Response();
        $response->withNothing();
        static::assertSame($response->status(), 204);
        static::assertNull($response->getData());
    }

    public function testSuccessfulResponseStatus(): void
    {
        $response = new Response();
        $response->with([], 201);
        static::assertSame($response->status(), 201);
    }

    public function testPublicAndPrivate(): void
    {
        $response = new Response();
        static::assertArrayNotHasKey('public', $response->getData(true));

        $response = new Response();
        $response->private();
        static::assertSame(['public' => false], $response->getData(true));

        $response = new Response();
        $response->public();
        static::assertSame(['public' => true], $response->getData(true));
    }
}
