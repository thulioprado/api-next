<?php

declare(strict_types=1);

namespace Directus\Framework\Contracts\Projects;

use Directus\Framework\Contracts\Collections\Collection;

/**
 * Directus project.
 */
interface Project
{
    /**
     * Gets the project name.
     */
    public function name(): string;

    /**
     * Checks if project is private.
     */
    public function private(): bool;

    /**
     * Gets a collection.
     */
    public function collection(string $name): Collection;
}
