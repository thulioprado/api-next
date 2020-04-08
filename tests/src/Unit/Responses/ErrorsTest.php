<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\Responses;

use Directus\Responses\Errors;
use Directus\Testing\TestCase;

/**
 * @internal
 * @covers \Directus\Responses\Errors
 */
final class ErrorsTest extends TestCase
{
    public function testErrorFor(): void
    {
        $error = Errors::for(Errors::SETTING_NOT_FOUND);

        static::assertArrayHasKey('code', $error);
        static::assertArrayHasKey('status', $error);
        static::assertArrayHasKey('message', $error);
        static::assertArrayHasKey('context', $error);

        static::assertSame(Errors::SETTING_NOT_FOUND, $error['code']);
        static::assertSame(404, $error['status']);
        static::assertSame(trans('directus::errors.'.Errors::SETTING_NOT_FOUND), $error['message']);
        static::assertSame([], $error['context']);
    }

    public function testUndefinedErrors(): void
    {
        $error = Errors::for('some_undefined_error');

        static::assertSame('some_undefined_error', $error['code']);
        static::assertSame('directus::errors.some_undefined_error', $error['message']);
        static::assertSame(500, $error['status']);
        static::assertSame([], $error['context']);
    }

    public function testErrorsShouldNotLeakSensitiveInformation(): void
    {
        $error = Errors::for(Errors::SETTING_NOT_FOUND, [
            'key' => 'this is public',
            'password' => 'oops, this is private',
        ]);

        static::assertStringContainsString('this is public', $error['message']);
        static::assertStringContainsString('this is public', $error['message']);
        static::assertSame([
            'key' => 'this is public',
        ], $error['context']);
    }
}
