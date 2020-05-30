<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\GraphQL;

use Directus\Database\Models\Setting;
use Directus\Testing\TestCase;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Arr;
use stdClass;

/**
 * @covers \Directus\GraphQL\Project\Resolvers\QueryResolver
 * @covers \Directus\GraphQL\Project\Resolvers\MutationResolver
 *
 * @internal
 */
final class SettingsTest extends TestCase
{
    use DatabaseTransactions,
        ArraySubsetAsserts;

    public function testSelectAll()
    {
        $settings = Setting::all()->toArray();
        $result = directus()
            ->graphql()
            ->project(config('directus.project.id', 'api'))
            ->execute('
                query {
                    settings {
                        key
                        value
                    }
                }
            ');

        static::assertArraySubset($settings, Arr::get($result->data, 'settings'));
    }

    public function testSelectOne()
    {
        $setting = Setting::all()->random(1)->first()->toArray();
        $result = directus()
            ->graphql()
            ->project(config('directus.project.id', 'api'))
            ->execute('
                query Query($key: String!) {
                    setting(key: $key) {
                        key
                        value
                    }
                }
            ', Arr::only($setting, 'key'));

        static::assertSame($setting, Arr::get($result->data, 'setting'));
    }

    public function testCreateOne()
    {
        $data = [
            'key' => 'directus_setting_test',
            'value' => '1234'
        ];

        $result = directus()
            ->graphql()
            ->project(config('directus.project.id', 'api'))
            ->mutation('createSetting')
            ->as('setting')
            ->select(['key', 'value'])
            ->execute($data);

        static::assertEquals($data, (array) Arr::get($result->data, 'setting'));
        static::assertDatabaseHas('directus_settings', $data);
    }

    public function testUpdateOne()
    {
        $setting = Setting::all()->random(1)->first()->toArray();
        $data = [
            'key' => Arr::get($setting, 'key'),
            'newKey' => 'directus_setting_test',
            'value' => '1234'
        ];

        $result = directus()
            ->graphql()
            ->project(config('directus.project.id', 'api'))
            ->mutation('updateSetting')
            ->as('setting')
            ->select(['key', 'value'])
            ->execute($data);

        Arr::set($data, 'key', Arr::get($data, 'newKey'));
        Arr::forget($data, 'newKey');

        static::assertEquals($data, (array) Arr::get($result->data, 'setting'));
        static::assertDatabaseHas('directus_settings', $data);
    }

    public function testDeleteOne()
    {
        $setting = Setting::all()->random(1)->first()->toArray();
        $result = directus()
            ->graphql()
            ->project(config('directus.project.id', 'api'))
            ->mutation('deleteSetting')
            ->as('setting')
            ->select(['key', 'value'])
            ->execute(Arr::only($setting, 'key'));

        static::assertEquals($setting, (array) Arr::get($result->data, 'setting'));
        static::assertDatabaseMissing('directus_settings', $setting);
    }
}
