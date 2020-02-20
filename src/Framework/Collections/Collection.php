<?php

declare(strict_types=1);

namespace Directus\Framework\Collections;

use Directus\Framework\Contracts\Collections\Collection as CollectionContract;
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
    private $_name;

    /**
     * @var Connection
     */
    private $_connection;

    /**
     * Constructor.
     */
    public function __construct(Connection $connection, string $name)
    {
        $this->_name = $name;
        $this->_connection = $connection;
    }

    /**
     * Items.
     */
    public function items(): Builder
    {
        return $this->_connection->table($this->_name);
    }
}
