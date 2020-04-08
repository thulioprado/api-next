<?php

declare(strict_types=1);

namespace Directus\Testing;

use Directus\Providers\DirectusProvider;
use Directus\Testing\Providers\TestingProvider;
use Generator;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

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
            TestingProvider::class,
        ]);
    }

    /**
     * Resolves a path to a data file.
     *
     * @param string $path
     */
    protected function getFilePath($path): string
    {
        $path = str_replace('\\', '/', $path);
        if ($path !== '' && strpos($path, '/') === 0) {
            $path = substr($path, 1);
        }

        return __DIR__.'/../data/'.$path;
    }
}
