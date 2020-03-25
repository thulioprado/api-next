<?php

declare(strict_types=1);

namespace Directus\Contracts\Database\System\Services;

use Directus\Database\System\Models\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface CollectionsService
{
    /**
     * Gets all collections.
     */
    public function all(): EloquentCollection;

    /**
     * Gets a collection instance.
     */
    public function getByName(string $name): Collection;

    /**
     * Creates a new collection.
     */
    public function register(string $name, ?string $id = null): void;

    /**
     * Deletes a collection.
     */
    public function unregister(string $id): void;
}
