<?php

declare(strict_types=1);

namespace Directus\Database\System\Models\Traits;

use Directus\Contracts\Database\Database;
use Illuminate\Database\Eloquent\Model;

/**
 * System model.
 *
 * @mixin Model
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
        $this->setIncrementing(false);
        $this->timestamps = false;
    }

    /**
     * Gets the system database.
     */
    protected function system(): Database
    {
        return resolve(Database::class, [
            'name' => 'system',
        ]);
    }
}
