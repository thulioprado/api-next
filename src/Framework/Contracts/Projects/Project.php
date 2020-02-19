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
     * Gets a collection.
     */
    public function collection(string $name): Collection;
}
