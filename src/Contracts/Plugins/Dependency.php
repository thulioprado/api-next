<?php

declare(strict_types=1);

namespace Directus\Contracts\Plugins;

/**
 * Interface Plugin.
 */
interface Dependency
{
    /**
     * Gets the plugin name.
     */
    public function name(): string;

    /**
     * Gets whether the dependency is optional or not.
     */
    public function optional(): bool;

    /**
     * Gets whether the dependency is required or not.
     */
    public function required(): bool;
}
