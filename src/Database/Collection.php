<?php

declare(strict_types=1);

namespace Directus\Database;

use Directus\Contracts\Database\Collection as CollectionContract;
use Directus\Contracts\Database\Database as DatabaseContract;
use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;

/**
 * Directus collection.
 */
class Collection implements CollectionContract
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * Constructor.
     */
    public function __construct(DatabaseContract $database, string $name)
    {
        $this->name = $name;
        $this->prefix = $database->prefix();

        /** @var Connection $connection */
        $connection = $database->connection();
        $this->connection = $connection;
    }

    public function name(): string
    {
        return $this->prefix.$this->name;
    }

    public function prefix(): string
    {
        return $this->prefix;
    }

    public function fullName(): string
    {
        return $this->connection->getTablePrefix().$this->prefix.$this->name;
    }

    public function builder(): Builder
    {
        return $this->connection->table($this->name());
    }

    public function drop(): void
    {
        $this->connection->getSchemaBuilder()->drop($this->name());
    }

    public function truncate(): void
    {
        $this->connection->table($this->name())->truncate();
    }
}
