<?php

declare(strict_types=1);

namespace Directus\Framework\Collections;

use Illuminate\Database\Query\Builder;
use Directus\Framework\Contracts\Collections\Collection as CollectionContract;

/**
 * Collection.
 */
class Collection implements CollectionContract
{
    /**
     * Items.
     */
    public function items(): Builder
    {
        return null;
    }
}
