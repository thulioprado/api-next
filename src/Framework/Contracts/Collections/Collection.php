<?php

declare(strict_types=1);

namespace Directus\Framework\Contracts\Collections;

use Illuminate\Database\Query\Builder;

/**
 * Directus projects.
 */
interface Collection
{
    /**
     * Gets items in the current collection.
     */
    public function items(): Builder;
}
