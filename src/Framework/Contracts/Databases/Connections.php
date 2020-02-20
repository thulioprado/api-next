<?php

declare(strict_types=1);

namespace Directus\Framework\Contracts\Databases;

use Illuminate\Database\ConnectionInterface;

/**
 * Config class.
 */
interface Connections
{
    /**
     * Gets the data database connection.
     */
    public function data(): ConnectionInterface;

    /**
     * Gets the system database connection.
     */
    public function system(): ConnectionInterface;
}
