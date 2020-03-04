<?php

declare(strict_types=1);

namespace Directus\Laravel\Database;

use Illuminate\Database\Migrations\Migration as IlluminateMigration;

/**
 * Directus migration.
 */
class Migration extends IlluminateMigration
{
    /**
     * Gets the formatted table name.
     */
    public function table(string $table): string
    {
        return config('directus.models.prefix', 'directus_').$table;
    }

    /**
     * Gets system connection name.
     */
    public function system(): string
    {
        $connection = config('directus.databases.system', 'default');
        if ($connection === 'default') {
            $connection = config('database.default');
        }

        return $connection;
    }
}
