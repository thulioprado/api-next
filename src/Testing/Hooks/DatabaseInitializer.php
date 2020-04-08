<?php

declare(strict_types=1);

namespace Directus\Testing\Hooks;

use Directus\Providers\DirectusProvider;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\Concerns\CreatesApplication;
use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\BeforeFirstTestHook;

class DatabaseInitializer implements BeforeFirstTestHook, AfterLastTestHook
{
    /**
     * @var string Database path
     */
    private $path = __DIR__.'/../../../tests/data/database.sqlite';

    /**
     * Executes before all tests.
     */
    public function executeBeforeFirstTest(): void
    {
        if (file_exists($this->path)) {
            @unlink($this->path);
        }
        @touch($this->path);

        $this->executeMigrations();
    }

    /**
     * Executes after all tests.
     */
    public function executeAfterLastTest(): void
    {
        if (file_exists($this->path)) {
            @unlink($this->path);
        }
    }

    /**
     * Execute the package migrations into the test database.
     */
    private function executeMigrations(): void
    {
        $bootstrap = new class() {
            use CreatesApplication;

            /**
             * @param Application $app
             */
            protected function getEnvironmentSetUp($app): void
            {
            }

            /**
             * @param Application $app
             */
            protected function getPackageProviders($app): array
            {
                return [
                    DirectusProvider::class,
                ];
            }
        };

        /** @var Application $app */
        $app = $bootstrap->createApplication();
        $app[Kernel::class]->call('migrate:fresh');
        $app->flush();
        $app = null;
    }
}
