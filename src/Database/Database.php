<?php

declare(strict_types=1);

namespace Directus\Database;

use Directus\Contracts\Database\Collection as CollectionContract;
use Directus\Contracts\Database\Database as DatabaseContract;
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

    /**
     * Prefix.
     */
    public function prefix(): string
    {
        return $this->prefix;
    }

    /**
     * Gets the connection name.
     */
    public function connectionName(): string
    {
        return $this->connection;
    }

    /**
     * Gets the connection.
     */
    public function connection(): ConnectionInterface
    {
        return DB::connection($this->connection);
    }

    /**
     * Gets the schema builder.
     */
    public function schema(): Builder
    {
        return Schema::connection($this->connection);
    }

    /**
     * Gets a database collection.
     */
    public function collection(string $name, ?string $class = null): CollectionContract
    {
        $class = $class ?? Collection::class;

        return new $class($this, $name);
    }
}
