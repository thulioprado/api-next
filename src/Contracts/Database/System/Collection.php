<?php

declare(strict_types=1);

namespace Directus\Contracts\Database\System;

use Directus\Contracts\Database\Collection as DatabaseCollection;

/**
 * Directus projects.
 */
interface Collection extends DatabaseCollection
{
    /**
     * Gets the collection name.
     */
    public function system(): Database;
}
