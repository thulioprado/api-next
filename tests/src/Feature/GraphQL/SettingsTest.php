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
    use DatabaseTransactions;
    use ArraySubsetAsserts;

    /**
     * @var string
     */
    protected $project;

    /**
     * @var array<string>
     */
    protected $settings;

    protected function setUp(): void
    {
        parent::setUp();

        $this->project = config('directus.project.id', 'api');
        $this->settings = Setting::all()->toArray();
    }

    public function testSelectAll()
    {
        $result = directus()->graphql()->project($this->project)->execute('
            query {
                settings {
                    key
                    value
                }
            }
        ');

        static::assertArraySubset($this->settings, Arr::get($result->data, 'settings'));
    }

    public function testSelectOne()
    {
        $setting = Arr::first($this->settings);
        $key = Arr::get($setting, 'key');

        $result = directus()->graphql()->project($this->project)->execute('
            query Query($key: String!) {
                setting(key: $key) {
                    key
                    value
                }
            }
        ', ['key' => $key]);

        static::assertSame($setting, Arr::get($result->data, 'setting'));
    }

    public function testCreateOne()
    {
        $data = [
            'key' => 'directus_setting_test',
            'value' => '1234'
        ];

        $result = directus()->graphql()->project($this->project)
            ->mutation('createSetting')
            ->as('setting')
            ->select(['key', 'value'])
            ->execute($data);

        static::assertEquals($data, (array)Arr::get($result->data, 'setting'));
    }

    public function testUpdateOne()
    {
    }

    public function testDeleteOne()
    {
    }
}
