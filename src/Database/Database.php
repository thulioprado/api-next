<?php

declare(strict_types=1);

namespace Directus\Database;

use Directus\Contracts\Database\Collection as CollectionContract;
use Directus\Contracts\Database\Database as DatabaseContract;
use Directus\Contracts\Database\Inspection\Inspector as InspectorContract;
use Directus\Database\Inspection\Inspector;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Database implementation.
 */
class Database implements DatabaseContract
{
    /**
     * @var string
     */
    private $connection;

    /**
     * @var string
     */
    private $prefix;

    /**
     * Constructor.
     */
    public function __construct(string $connection, string $prefix = '')
    {
        $this->connection = $connection;
        $this->prefix = $prefix;
    }

    public function prefix(): string
    {
        return $this->prefix;
    }

    public function driver(): string
    {
        return (string) config("database.connections.{$this->connection}.driver");
    }

    public function connectionName(): string
    {
        return $this->connection;
    }

    public function connection(): ConnectionInterface
    {
        return DB::connection($this->connection);
    }

    public function schema(): Builder
    {
        return Schema::connection($this->connection);
    }

    public function collection(string $name, ?string $class = null): CollectionContract
    {
        $class = $class ?? Collection::class;

        return new $class($this, $name);
    }

    public function inspector(): InspectorContract
    {
        return new Inspector($this);
    }

    /**
     * Runs a transaction over the two databases.
     *
     * @throws \Throwable
     *
     * @return mixed
     */
    public function transaction(\Closure $callback)
    {
        return $this->connection()->transaction($callback);
    }
}
