<?php

declare(strict_types=1);

namespace Directus\Framework\Contracts\Projects;

use Illuminate\Support\Collection;

/**
 * Directus projects.
 */
interface Repository
{
    /**
     * Lists all available project names.
     */
    public function all(): Collection;

    /**
     * Creates a project by its name.
     */
    public function project(string $name): Project;

    /**
     * Checks if a project exists.
     */
    public function exists(string $name): bool;
}
