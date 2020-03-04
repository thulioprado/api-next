<?php

declare(strict_types=1);

namespace Directus\Laravel\Database\Traits;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;

/**
 * Directus migration.
 */
trait SystemBuilder
{
    /**
     * Gets system connection name.
     */
    public function system(): Builder
    {
        $connection = config('directus.databases.system', 'default');
        if ($connection === 'default') {
            $connection = config('database.default');
        }

        return Schema::connection($connection);
    }
}
