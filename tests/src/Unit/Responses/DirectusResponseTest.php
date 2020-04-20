<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\Responses;

use Directus\Responses\DirectusResponse;
use Directus\Responses\Errors;
use Directus\Testing\TestCase;

/**
 * @covers \Directus\Responses\DirectusResponse
 *
 * @internal
 */
final class DirectusResponseTest extends TestCase
{
    public function testSuccessfulResponse(): void
    {
        $response = new DirectusResponse();
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
        $response = new DirectusResponse();
        $response->withNothing();
        static::assertSame($response->status(), 204);
        static::assertNull($response->getData());
    }

    public function testSuccessfulResponseStatus(): void
    {
        $response = new DirectusResponse();
        $response->with([], 201);
        static::assertSame($response->status(), 201);
    }

    public function testPublicAndPrivate(): void
    {
        $response = new DirectusResponse();
        static::assertArrayNotHasKey('public', $response->getData(true));

        $response = new DirectusResponse();
        $response->private();
        static::assertSame(['public' => false], $response->getData(true));

        $response = new DirectusResponse();
        $response->public();
        static::assertSame(['public' => true], $response->getData(true));
    }

    public function testFailedResponse(): void
    {
        $response = new DirectusResponse();
        $response->withError(Errors::SETTING_NOT_FOUND, ['key' => 'hello']);

        static::assertSame(404, $response->status());
        static::assertSame([
            'error' => [
                'code' => Errors::SETTING_NOT_FOUND,
                'message' => 'Setting "hello" not found',
                'context' => [
                    'key' => 'hello',
                ],
            ],
        ], $response->getData(true));
    }
}
