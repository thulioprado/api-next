<?php

declare(strict_types=1);

namespace Directus\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Main provider.
 */
class MainProvider extends ServiceProvider
{
    /**
     * Service register.
     */
    public function register(): void
    {
        $this->app->register(AdminProvider::class);

        $this->app->register(DirectusProvider::class);

        $this->app->register(RoutesProvider::class);
    }
}
