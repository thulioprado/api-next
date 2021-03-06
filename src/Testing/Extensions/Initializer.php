<?php

declare(strict_types=1);

namespace Directus\Testing\Extensions;

use Directus\Providers\DirectusProvider;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\Concerns\CreatesApplication;
use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\BeforeFirstTestHook;

class Initializer implements BeforeFirstTestHook, AfterLastTestHook
{
    public static function path(): string
    {
        return __DIR__.'/../../../tests/data/database.sqlite';
    }

    public static function database(): string
    {
        $database = env('TEST_DATABASE', 'memory');
        $aliases = [
            'pg' => 'pgsql',
            'postgresql' => 'pgsql',
            'postgres' => 'pgsql',
            'mysql2' => 'mysql',
            'sqlite3' => 'sqlite',
            'mssql' => 'sqlsrv',
            'mssqlrv' => 'sqlsrv',
            'sqlserver' => 'sqlsrv',
        ];

        return $aliases[$database] ?? $database;
    }

    public function executeBeforeFirstTest(): void
    {
        if (static::database() === 'sqlite') {
            if (file_exists(static::path())) {
                @unlink(static::path());
            }
            @touch(static::path());
        }

        $this->executeInstall();
    }

    public function executeAfterLastTest(): void
    {
        if (static::database() === 'sqlite') {
            if (file_exists(static::path())) {
                @unlink(static::path());
            }
        }
    }

    public static function setupApplication(Repository $config): void
    {
        $config->set('app.env', env('APP_ENV', 'testing'));
        $config->set('cache.default', env('CACHE_DRIVER', 'array'));
        $config->set('session.driver', env('SESSION_DRIVER', 'array'));
        $config->set('queue.default', env('QUEUE_DRIVER', 'sync'));
        $config->set('database.default', env('DB_CONNECTION', 'testing'));

        $databases = [
            'sqlite' => [
                'driver' => 'sqlite',
                'database' => static::path(),
                'prefix' => '',
                'foreign_key_constraints' => true,
            ],
            'mysql' => [
                'driver' => 'mysql',
                'url' => null,
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => env('DB_DATABASE', 'directus'),
                'username' => env('DB_USERNAME', 'directus'),
                'password' => env('DB_PASSWORD', 'directus'),
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
                'options' => extension_loaded('pdo_mysql') ? array_filter([
                    \PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                ]) : [],
            ],
            'pgsql' => [
                'driver' => 'pgsql',
                'url' => env('DATABASE_URL'),
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '5432'),
                'database' => env('DB_DATABASE', 'directus'),
                'username' => env('DB_USERNAME', 'directus'),
                'password' => env('DB_PASSWORD', 'directus'),
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
                'schema' => 'public',
                'sslmode' => 'prefer',
            ],
            'sqlsrv' => [
                'driver' => 'sqlsrv',
                'url' => env('DATABASE_URL'),
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', '1433'),
                'database' => env('DB_DATABASE', 'directus'),
                'username' => env('DB_USERNAME', 'directus'),
                'password' => env('DB_PASSWORD', 'directus'),
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
            ],
        ];

        $database = static::database();
        if (isset($databases[$database])) {
            $config->set('database.connections.testing', $databases[$database]);
        }
    }

    /**
     * Execute the package migrations into the test database.
     */
    private function executeInstall(): void
    {
        $bootstrap = new class() {
            use CreatesApplication;

            /**
             * @param Application $app
             */
            protected function getEnvironmentSetUp($app): void
            {
                Initializer::setupApplication(app('config'));
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

        // @var Application $app
        Container::setInstance($app = $bootstrap->createApplication());

        $app[Kernel::class]->call('directus:install', [
            '--email' => 'admin@example.com',
            '--password' => 'password',
        ]);

        directus()->databases()->seed();

        $app->flush();

        Container::setInstance($app = null);
    }
}
