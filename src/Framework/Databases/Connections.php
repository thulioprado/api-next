<?php

declare(strict_types=1);

namespace Directus\Framework\Databases;

use Directus\Framework\Contracts\Databases\Connections as ConnectionsContract;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\ConnectionInterface;

final class Connections implements ConnectionsContract
{
    /**
     * Database manager.
     *
     * @var Manager
     */
    private $_manager;

    /**
     * Database connections configuration.
     *
     * @var Repository
     */
    private $_config;

    /**
     * Constructor.
     */
    public function __construct(Manager $manager, Repository $config)
    {
        $this->_manager = $manager;
        $this->_config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function data(): ConnectionInterface
    {
        return $this->_manager->getConnection($this->_config->get('databases.data'));
    }

    /**
     * {@inheritdoc}
     */
    public function system(): ConnectionInterface
    {
        return $this->_manager->getConnection($this->_config->get('databases.system'));
    }
}
