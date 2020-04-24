<?php

declare(strict_types=1);

namespace Directus\Services\Databases;

use Directus\Contracts\Database\Database;
use Directus\Contracts\Services\Service;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class DatabasesService.
 */
class DatabasesService implements Service
{
    /**
     * @var bool
     */
    protected $logging = false;

    /**
     * @var array<string>
     */
    protected $queries = [];

    /**
     * DatabasesService constructor.
     */
    public function __construct()
    {
        DB::listen(function($query) {
            if (!$this->logging) {
                return;
            }

            $this->queries[] = [
                'query' => $query->sql,
                'time' => "{$query->time} sec",
                'connection' => $query->connectionName
            ];
        });
    }

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
     * Captures all queries.
     */
    public function startTrace(): void
    {
        $this->queries = [];
        $this->logging = true;
    }

    /**
     * Captures all queries.
     */
    public function stopTrace(): void
    {
        $this->logging = false;
    }

    /**
     * Traces database queries.
     */
    public function trace(Callable $callback): array
    {
        $this->queries = [];
        if (is_callable($callback)) {
            $this->logging = true;
            try {
                $callback();
            } finally {
                $this->logging = false;
            }
        }
        return $this->queries;
    }

    /**
     * @return array
     */
    public function queries(): array
    {
        return $this->queries;
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
