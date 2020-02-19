<?php

declare(strict_types=1);

namespace Directus\Laravel\Providers;

use Directus\Laravel\Commands\Migrate;
use Illuminate\Support\ServiceProvider;

/**
 * Directus provider.
 */
class CommandLineProvider extends ServiceProvider
{
    /**
     * Service boot.
     */
    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Migrate::class,
        ]);
    }
}
