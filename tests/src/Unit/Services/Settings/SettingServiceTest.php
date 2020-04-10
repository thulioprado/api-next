<?php

declare(strict_types=1);

namespace Directus\Tests\Unit\Services\Settings;

use Directus\Exceptions\SettingAlreadyExists;
use Directus\Exceptions\SettingNotFound;
use Directus\Services\Settings\SettingsService;
use Directus\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

/**
 * @covers \Directus\Services\Settings\SettingsService
 *
 * @internal
 */
final class SettingServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var SettingsService
     */
    private $settings;

    protected function setUp(): void
    {
        parent::setUp();

        $this->settings = directus()->settings();
    }

    public function testAllReturnsAllRecords(): void
    {
        $all = $this->settings->all();
        static::assertCount(DB::table('directus_settings')->count(), $all);
    }

    public function testGetReturnsKnownValue(): void
    {
        $telemetry = $this->settings->get('telemetry');
        static::assertTrue($telemetry);
    }

    public function testGetDefaultValueIsNull(): void
    {
        $unknown = $this->settings->get('unknown');
        static::assertNull($unknown);
    }

    public function testGetSupportsDefaultValue(): void
    {
        $unknown = $this->settings->get('unknown', 'default_value');
        static::assertSame('default_value', $unknown);
    }

    public function testSetCanUpdateValues(): void
    {
        static::assertTrue($this->settings->get('telemetry'));

        $this->settings->set('telemetry', false);

        static::assertFalse($this->settings->get('telemetry'));
    }

    public function testSetCanSetUnknownValue(): void
    {
        static::assertNull($this->settings->get('unknown'));
        $this->settings->set('unknown', 1337);
        static::assertSame(1337, $this->settings->get('unknown'));
    }

    public function testSetCanChangeDataType(): void
    {
        $this->settings->set('telemetry', 1234);
        static::assertSame(1234, $this->settings->get('telemetry'));

        $this->settings->set('telemetry', 'hello');
        static::assertSame('hello', $this->settings->get('telemetry'));
    }

    public function testCreateFailsIfSettingAlreadyExists(): void
    {
        $this->expectException(SettingAlreadyExists::class);
        $this->settings->create('telemetry', 'value');
    }

    public function testUpdateShouldUpdateValues(): void
    {
        $this->settings->update('telemetry', 'value');
        static::assertSame('value', $this->settings->get('telemetry'));
    }

    public function testUpdateShouldFailIfValueDoesntExists(): void
    {
        $this->expectException(SettingNotFound::class);
        $this->settings->update('unknown', 'value');
    }

    public function testDeleteShouldDeleteSetting(): void
    {
        static::assertTrue($this->settings->get('telemetry'));
        $this->settings->delete('telemetry');

        static::assertNull($this->settings->get('telemetry'));
        static::assertSame(1234, $this->settings->get('telemetry', 1234));
    }
}
