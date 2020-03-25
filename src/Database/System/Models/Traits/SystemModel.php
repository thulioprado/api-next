<?php

declare(strict_types=1);

namespace Directus\Database\System\Models\Traits;

use Directus\Contracts\Database\System\Database as SystemDatabase;

/**
 * System model.
 */
trait SystemModel
{
    /**
     * Model constructor.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $system = $this->system();

        $this->setConnection($system->connectionName());
        $this->setTable($system->collection($this->getTable())->name());
        $this->setKeyType('uuid');
        $this->setIncrementing(false);
        $this->timestamps = false;
    }

    /**
     * Gets the system database.
     */
    protected function system(): SystemDatabase
    {
        return resolve(SystemDatabase::class);
    }
}
