<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Testing\TestCase;

/**
 * @covers \Directus\Controllers\ServerController
 *
 * @internal
 */
final class ServerControllerTest extends TestCase
{
    protected function setUp(): void
    {
        $this->markTestSkipped();
    }

    public function testInfo(): void
    {
        $this->getJson('/server/info')->assertResponseStructure([
            'directus' => [
                'version',
                'plugins',
            ],
            'env' => [
                'name',
                'server',
                'container',
                'os',
            ],
            'php' => [
                'architecture',
                'version',
                'settings' => [
                    'upload_max_filesize',
                ],
                'extensions',
            ],
            'laravel' => [
                'version',
                'locale',
            ],
        ]);
    }

    public function testPing(): void
    {
        $this->getJson('/server/ping')->assertResponseIs([
            'pong' => true,
        ]);
    }

    public function testProjects(): void
    {
        $response = $this->getJson('/server/projects')->assertResponse()->data();
        static::assertIsArray($response);
        static::assertCount(1, $response);
    }
}
