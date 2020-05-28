<?php

/** @noinspection PhpUndefinedClassInspection */

declare(strict_types=1);

namespace Directus\Testing\Providers;

use Carbon\Laravel\ServiceProvider;
use Directus\Testing\Extensions\Initializer;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Assert;

class TestingProvider extends ServiceProvider
{
    /**
     * @noinspection StaticClosureCanBeUsedInspection
     */
    public function register(): void
    {
        Initializer::setupApplication(app('config'));

        TestResponse::macro('data', function () {
            /** @var TestResponse $response */
            $response = $this;

            return $response->assertResponse()->json('data');
        });

        TestResponse::macro('error', function () {
            /** @var TestResponse $response */
            $response = $this;

            return $response->assertError()->json('error');
        });

        TestResponse::macro('assertResponse', function (): TestResponse {
            /** @var TestResponse $response */
            $response = $this;

            return $response->assertSuccessful()->assertJsonStructure([
                'data',
            ]);
        });

        TestResponse::macro('assertResponseIs', function (array $data): TestResponse {
            /** @var TestResponse $response */
            $response = $this;

            return $response->assertResponse()->assertExactJson([
                'data' => $data,
            ]);
        });

        TestResponse::macro('assertResponseIsEmpty', function (array $data): TestResponse {
            /** @var TestResponse $response */
            $response = $this;

            return $response->assertNoContent();
        });

        TestResponse::macro('assertResponseHas', function (array $data): TestResponse {
            /** @var TestResponse $response */
            $response = $this;

            return $response->assertResponse()->assertJson([
                'data' => $data,
            ]);
        });

        TestResponse::macro('assertResponseStructure', function (array $structure): TestResponse {
            /** @var TestResponse $response */
            $response = $this;

            return $response->assertResponse()->assertJsonStructure([
                'data' => $structure,
            ]);
        });

        TestResponse::macro('assertError', function (): TestResponse {
            /** @var TestResponse $response */
            $response = $this;

            $response->assertJsonStructure([
                'error' => [
                    'code',
                    'message',
                    'context',
                ],
            ]);

            Assert::assertGreaterThanOrEqual(400, $response->status(), 'Should have an error status');

            return $response;
        });

        TestResponse::macro('assertErrorCode', function (string $code): TestResponse {
            /** @var TestResponse $response */
            $response = $this;

            return $response->assertError()->assertJson([
                'error' => [
                    'code' => $code,
                ],
            ]);
        });

        TestResponse::macro('assertErrorMessage', function (string $message): TestResponse {
            /** @var TestResponse $response */
            $response = $this;

            return $response->assertError()->assertJson([
                'error' => [
                    'message' => $message,
                ],
            ]);
        });

        TestResponse::macro('assertErrorMessageContains', function (string $message): TestResponse {
            /** @var TestResponse $response */
            $response = $this;

            $data = $response->decodeResponseJson();
            $response->assertError();

            Assert::assertStringContainsString(
                $message,
                $data['error']['message'],
            );

            return $response;
        });
    }
}
