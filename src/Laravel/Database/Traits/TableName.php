<?php

declare(strict_types=1);

namespace Directus\Laravel\Database\Traits;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;

/**
 * Database table name.
 */
trait TableName
{
    /**
     * Gets system connection name.
     */
    public function tableName(string $table): string
    {
        return config('directus.models.prefix', 'directus_') . $table;
    }
}
