<?php

declare(strict_types=1);

namespace Directus;

use Directus\Contracts\Database\Database;
use Directus\Contracts\Database\System\Database as SystemDatabase;
use Directus\Contracts\Database\System\Services\CollectionsService;
use Directus\Contracts\Database\System\Services\FieldsService;

/**
 * Directus.
 */
final class Directus
{
    /**
     * Gets the collections service.
     */
    public function database(): Database
    {
        return resolve(Database::class);
    }

    /**
     * Gets the collections service.
     */
    public function system(): SystemDatabase
    {
        return resolve(SystemDatabase::class);
    }

    /**
     * Gets the collections service.
     */
    public function collections(): CollectionsService
    {
        return resolve(CollectionsService::class);
    }

    /**
     * Gets the fields service.
     */
    public function fields(): FieldsService
    {
        return resolve(FieldsService::class);
    }
}
