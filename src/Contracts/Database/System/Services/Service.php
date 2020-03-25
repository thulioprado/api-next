<?php

declare(strict_types=1);

namespace Directus\Contracts\Database\System\Services;

use Directus\Contracts\Database\System\Database;

/**
 * Fields interface.
 */
interface Service
{
    /**
     * Gets the system database.
     */
    public function system(): Database;
}
