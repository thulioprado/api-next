<?php

declare(strict_types=1);

namespace Directus\Tests\Feature\Controllers;

use Directus\Testing\TestCase;

/**
 * @covers \Directus\Controllers\ProjectController
 *
 * @internal
 */
final class ProjectControllerTest extends TestCase
{
    public function testProjectInfo(): void
    {
        $this->getJson('/directus')->assertResponseStructure([
            'name',
            'url',
            'public_note',
            'logo',
            'color',
            'files' => [
                'foreground',
                'background',
            ],
            'telemetry',
            'default_locale',
            'api' => [
                'version',
                'requires2FA',
                'database' => [
                    'user',
                    'system',
                ],
                'project_name',
                'project_logo',
                'project_color',
                'project_foreground',
                'project_background',
                'telemetry',
                'default_locale',
                'project_public_note',
            ],
            'server' => [
                'max_upload_size',
                'general' => [
                    'php_version',
                    'php_api',
                ],
            ],
        ]);
    }
}
