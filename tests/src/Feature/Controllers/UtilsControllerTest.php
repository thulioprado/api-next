<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Testing\TestCase;
use Illuminate\Support\Facades\Hash;

/**
 * @internal
 * @covers \Directus\Controllers\UtilsController
 */
final class UtilsControllerTest extends TestCase
{
    public function testRandom(): void
    {
        $this->getJson('/directus/utils/random/string')
            ->assertResponseStructure([
                'random',
            ])
        ;
    }

    public function testRandomIsRandom(): void
    {
        $random1 = $this->getJson('/directus/utils/random/string')->json();
        $random2 = $this->getJson('/directus/utils/random/string')->json();
        static::assertNotSame(
            $random1['data']['random'],
            $random2['data']['random']
        );
    }

    public function testRandomLength(): void
    {
        $response = $this->getJson('/directus/utils/random/string?length=76')->json();
        static::assertSame(76, \strlen($response['data']['random']));

        $response = $this->getJson('/directus/utils/random/string?length=43')->json();
        static::assertSame(43, \strlen($response['data']['random']));
    }

    public function testRandomLengthLimits(): void
    {
        $this->getJson('/directus/utils/random/string?length=10')->assertSuccessful();
        $this->getJson('/directus/utils/random/string?length=0')->assertJsonValidationErrors(['length']);
        $this->getJson('/directus/utils/random/string?length=129')->assertJsonValidationErrors(['length']);
    }

    public function testHashCreate(): void
    {
        $response = $this->postJson('/directus/utils/hash', [
            'string' => 'wolfulus',
        ]);

        $response->assertResponseStructure([
            'hash',
        ]);

        static::assertTrue(Hash::check('wolfulus', $response->json('data.hash')));
    }

    public function testHashCreateParameters(): void
    {
        // string is required
        $response = $this->postJson('/directus/utils/hash', []);
        $response->assertStatus(422)->assertJsonValidationErrors(['string']);

        // string is a string
        $response = $this->postJson('/directus/utils/hash', ['string' => 1234]);
        $response->assertStatus(422)->assertJsonValidationErrors(['string']);
    }

    public function testHashVerify(): void
    {
        $hash = Hash::make('wolfulus');
        $response = $this->postJson('/directus/utils/hash/match', [
            'string' => 'wolfulus',
            'hash' => $hash,
        ]);

        $response->assertResponseIs([
            'valid' => true,
        ]);
    }

    public function testHashVerifyParameters(): void
    {
        $response = $this->postJson('/directus/utils/hash/match', []);
        $response->assertStatus(422)->assertJsonValidationErrors(['hash', 'string']);

        $response = $this->postJson('/directus/utils/hash/match', [
            'hash' => 1234,
            'string' => 1234,
        ]);
        $response->assertStatus(422)->assertJsonValidationErrors(['hash', 'string']);
    }
}
