<?php

declare(strict_types=1);

namespace Directus\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Migrations provider.
 */
class MigrationsProvider extends ServiceProvider
{
    /**
     * Service boot.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}
