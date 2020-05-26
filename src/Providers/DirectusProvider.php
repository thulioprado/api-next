<?php

declare(strict_types=1);

namespace Directus\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Directus provider.
 */
class DirectusProvider extends ServiceProvider
{
    /**
     * Service register.
     */
    public function register(): void
    {
        $this->app->register(UtilsProvider::class);
        $this->app->register(ConfigProvider::class);
        $this->app->register(TranslationProvider::class);
        $this->app->register(DependenciesProvider::class);
        $this->app->register(ServicesProvider::class);
        $this->app->register(EventsProvider::class);
        $this->app->register(RoutesProvider::class);
        $this->app->register(MigrationsProvider::class);
        $this->app->register(CommandsProvider::class);
        $this->app->register(GraphQLProvider::class);
        $this->app->register(PluginsProvider::class);
    }
}
