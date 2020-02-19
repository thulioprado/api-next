<?php

declare(strict_types=1);

namespace Directus\Core\Projects\Repositories;

use Directus\Core\Project;

/**
 * Directus project.
 */
interface RepositoryInterface
{
    public function keys(): array;

    public function exists(string $name): bool;

    public function get(string $name): Project;
}
