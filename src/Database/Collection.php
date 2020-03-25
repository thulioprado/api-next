<?php

declare(strict_types=1);

namespace Directus\Database;

use Directus\Contracts\Database\Collection as CollectionContract;
use Directus\Contracts\Database\Database as DatabaseContract;
use Illuminate\Database\Connection;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;

/**
 * Directus collection.
 */
class Collection implements CollectionContract
{
    /**
     * @var string
     */
    private $_name;

    /**
     * @var string
     */
    private $_prefix;

    /**
     * @var DatabaseContract
     */
    private $_database;

    /**
     * @var Connection
     */
    private $_connection;

    /**
     * Constructor.
     */
    public function __construct(DatabaseContract $database, string $name)
    {
        $this->_name = $name;
        $this->_database = $database;
        /** @var Connection */
        $conn = $database->connection();
        $this->_connection = $conn;
        $this->_prefix = $database->prefix();
    }

    /**
     *  {@inheritdoc}
     */
    public function name(): string
    {
        return $this->_prefix.$this->_name;
    }

    /**
     * {@inheritdoc}
     */
    public function prefix(): string
    {
        return $this->_prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function fullName(): string
    {
        return $this->_connection->getTablePrefix().$this->_prefix.$this->_name;
    }

    /**
     * {@inheritdoc}
     */
    public function query(): Builder
    {
        return $this->_connection->table($this->name());
    }

    /**
     * {@inheritdoc}
     */
    public function drop(): void
    {
        $this->_connection->getSchemaBuilder()->drop($this->name());
    }

    /**
     * {@inheritdoc}
     */
    public function truncate(): void
    {
        $this->_connection->table($this->name())->truncate();
    }

    /**
     * Gets the current database.
     */
    protected function database(): DatabaseContract
    {
        return $this->_database;
    }

    /**
     * Gets the current database.
     */
    protected function connection(): ConnectionInterface
    {
        return $this->_connection;
    }
}
