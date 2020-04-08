<?php

declare(strict_types=1);

namespace Directus\Contracts\Database;

use Illuminate\Database\Query\Builder;

/**
 * Directus projects.
 */
interface Collection
{
    /**
     * Gets the collection name.
     */
    public function name(): string;

    /**
     * Gets the collection prefix.
     */
    public function prefix(): string;

    /**
     * Gets the collection name with prefix.
     */
    public function fullName(): string;

    /**
     * Gets items in the current collection.
     */
    public function builder(): Builder;

    /**
     * Drops the collection.
     */
    public function drop(): void;

    /**
     * Truncates the collection.
     */
    public function truncate(): void;
}
