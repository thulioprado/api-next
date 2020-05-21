<?php

declare(strict_types=1);

namespace Directus\Contracts\Plugins;

/**
 * Interface Plugin.
 */
interface Plugin
{
    /**
     * Gets the plugin info.
     */
    public function info(): array;

    /**
     * Gets all plugin dependencies.
     *
     * @return array<Dependency>
     */
    public function dependencies(): array;

    /**
     * Boots the plugin (under same laravel lifecycle).
     */
    public function boot(): void;

    /**
     * Registers the plugin (under same laravel lifecycle).
     */
    public function register(): void;
}
