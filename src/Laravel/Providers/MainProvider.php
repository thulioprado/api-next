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
        //die('hello');

        $this->app->register(AdminProvider::class);

        $this->app->register(DirectusProvider::class);

        $this->app->register(IdentificationProvider::class);
        $this->app->register(ProjectProvider::class);

        $this->app->register(CommandLineProvider::class);

        $this->app->register(RoutesProvider::class);
    }
}
