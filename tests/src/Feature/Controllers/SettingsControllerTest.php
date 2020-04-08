<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Responses\Errors;
use Directus\Testing\TestCase;

/**
 * @internal
 * @covers \Directus\Controllers\SettingsController
 */
final class SettingsControllerTest extends TestCase
{
    public function testAll(): void
    {
        $data = $this->getJson('/directus/settings')->data();
        static::assertIsArray($data);
        static::assertCount(21, $data);
    }

    public function testFindOne(): void
    {
        $this->getJson('/directus/settings/asset_url_naming')->assertResponseIs([
            'key' => 'asset_url_naming',
            'value' => 'private_hash',
        ]);
    }

    public function testNotFound(): void
    {
        $this->getJson('/directus/settings/asset_url_namings')->assertErrorCode('setting_not_found');
    }

    public function testCreate(): void
    {
        $this->postJson('/directus/settings', [
            'key' => 'some_custom_setting',
            'value' => [
                'hello' => 'world',
            ],
        ])->assertResponseIs([
            'key' => 'some_custom_setting',
            'value' => [
                'hello' => 'world',
            ],
        ]);

        $this->assertDatabaseHas('directus_settings', ['key' => 'some_custom_setting']);
    }

    public function testUpdate(): void
    {
        $this->patchJson('/directus/settings/some_custom_setting', [
            'value' => 'new value',
        ])->assertResponseIs([
            'key' => 'some_custom_setting',
            'value' => 'new value',
        ]);

        $this->assertDatabaseHas('directus_settings', [
            'key' => 'some_custom_setting',
            'value' => '"new value"',
        ]);
    }

    public function testUpdateUnknown(): void
    {
        $this->patchJson('/directus/settings/some_unknown_setting', [
            'value' => 'new value',
        ])->assertErrorCode(Errors::SETTING_NOT_FOUND);
    }

    public function testCreateAlreadyExists(): void
    {
        $this->postJson('/directus/settings', [
            'key' => 'asset_url_naming',
            'value' => 'another_value',
        ])->assertErrorCode(Errors::SETTING_ALREADY_EXISTS);
    }

    public function testDelete(): void
    {
        $this->deleteJson('/directus/settings/some_custom_setting')
            ->assertNoContent()
        ;
    }

    public function testDeleteUnknown(): void
    {
        $this->deleteJson('/directus/settings/some_unknown_setting')
            ->assertErrorCode(Errors::SETTING_NOT_FOUND)
        ;
    }
}
