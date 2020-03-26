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
    private $systemDatabase;

    /**
     * Constructor.
     */
    public function __construct(Database $database, string $name)
    {
        $this->systemDatabase = $database;
        parent::__construct($database, $name);
    }

    public function system(): Database
    {
        return $this->systemDatabase;
    }
}
