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
    protected $_system;

    /**
     * {@inheritdoc}
     */
    public function system(): Database
    {
        return $this->_system = $this->_system ?? resolve(Database::class);
    }
}
