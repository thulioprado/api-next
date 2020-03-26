<?php

declare(strict_types=1);

namespace Directus\Database\System\Services;

use Directus\Contracts\Database\System\Database;
use Directus\Contracts\Database\System\Services\Service as ServiceContract;

/**
 * Class Service.
 */
class Service implements ServiceContract
{
    /**
     * @var Database
     */
    protected $system;

    public function system(): Database
    {
        return $this->system = $this->system ?? resolve(Database::class);
    }
}
