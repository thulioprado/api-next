<?php

declare(strict_types=1);

namespace Directus\Services\Databases;

use Directus\Contracts\Database\Database;
use Directus\Contracts\Services\Service;
use Throwable;

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

    /**
     * Runs a transaction over the two databases.
     *
     * @throws Throwable
     *
     * @return mixed
     */
    public function transaction(callable $callback)
    {
        $value = null;
        $this->system()->connection()->transaction(function () use (&$value, $callback): void {
            $this->database()->connection()->transaction(static function () use (&$value, $callback): void {
                $value = $callback();
            });
        });

        return $value;
    }
}
