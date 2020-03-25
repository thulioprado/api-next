<?php

declare(strict_types=1);

namespace Directus\Database\System;

use Directus\Contracts\Database\System\Database;
use Directus\Database\Collection as DatabaseCollection;

/**
 * Directus collection.
 */
class Collection extends DatabaseCollection implements \Directus\Contracts\Database\System\Collection
{
    /**
     * @var Database
     */
    private $_system;

    /**
     * Constructor.
     */
    public function __construct(Database $database, string $name)
    {
        $this->_system = $database;
        parent::__construct($database, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function system(): Database
    {
        return $this->_system;
    }
}
