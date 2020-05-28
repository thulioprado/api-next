<?php

declare(strict_types=1);

namespace Directus\Testing;

use Directus\Providers\DirectusProvider;
use Generator;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Webmozart\PathUtil\Path;

/**
 * PHP Provider tests.
 */
abstract class TestCase extends OrchestraTestCase
{
    /**
     * @var bool
     */
    protected static $initialized = false;

    /**
     * @param mixed $parameters
     */
    protected function runTraits(string $prefix, $parameters = []): Generator
    {
        $class = static::class;
        $methods = [];

        foreach (class_uses_recursive($class) as $trait) {
            $candidates = get_class_methods($trait);
            $methods[] = array_filter($candidates, function ($method) use ($prefix): bool {
                return $method !== $prefix && strpos($method, $prefix) === 0;
            });
        }

        $methods = Arr::flatten($methods);
        foreach ($methods as $method) {
            $callable = [$this, $method];
            if (\is_callable($callable)) {
                yield \call_user_func_array($callable, $parameters);
            }
        }
    }

    /**
     * Get package service providers.
     *
     * @param Application $app
     */
    protected function getPackageProviders($app): array
    {
        return Arr::flatten([
            DirectusProvider::class,
        ]);
    }

    protected function getDataFilesystem(string $root = '', array $config = [])
    {
        Storage::set('test_data', $storage = Storage::createLocalDriver(array_merge($config, [
            'root' => $this->getDataPath($root),
        ])));

        return $storage;
    }

    /**
     * Resolves a path to a data file.
     */
    protected function getDataPath(string $file = ''): string
    {
        $root = sprintf('%s/tests/data/', dirname(__DIR__, 2));
        if ($root === false) {
            throw new \RuntimeException('Missing tests data folder');
        }

        return Path::join($root, $file);
    }
}
