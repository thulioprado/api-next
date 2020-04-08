<?php

declare(strict_types=1);

namespace Directus\Services\Databases;

use Directus\Contracts\Database\Database;
use Directus\Contracts\Services\Service;

/**
 * Class DatabasesService.
 */
class DatabasesService implements Service
{
    /**
     * Gets the collections service.
     */
    public function database(): Database
    {
        return resolve(Database::class, [
            'name' => 'data',
        ]);
    }

    /**
     * Gets the system database.
     */
    public function system(): Database
    {
        return resolve(Database::class, [
            'name' => 'system',
        ]);
    }
}
