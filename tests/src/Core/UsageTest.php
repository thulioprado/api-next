<?php

declare(strict_types=1);

namespace Directus\Tests\Core;

use Directus\Tests\Helpers\DirectusTestCase;

/**
 * @internal
 * @coversNothing
 */
final class UsageTest extends DirectusTestCase
{
    /**
     * Some example usage.
     */
    public function testMultipleProjects(): void
    {
        $repository = new FileRepository([
            'path' => $this->getDataFilePath('config/projects/{project}.php'),
        ]);

        $project = $repository->get('project1');
    }

    /**
     * Some example usage.
     */
    public function testSimple(): void
    {
        $repository = new FilesRepository([
            'path' => $this->getDataFilePath('config/projects/{project}.php'),
        ]);

        $project = $repository->get('project1');
    }
}
