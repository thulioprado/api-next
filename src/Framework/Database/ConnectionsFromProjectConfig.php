<?php

declare(strict_types=1);

namespace Directus\Framework\Database;

use Directus\Framework\Contracts\Databases\Connections as ConnectionsContract;
use Directus\Framework\Contracts\Projects\Project;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\ConnectionInterface;

/**
 * Directus database manager.
 */
final class ConnectionsFromProjectConfig implements ConnectionsContract
{
    /**
     * Data name.
     */
    public const DATABASE_DATA = 'data';

    /**
     * System name.
     */
    public const DATABASE_SYSTEM = 'system';

    /**
     * System connection.
     *
     * @var ConnectionInterface[]
     */
    private $_connections;

    /**
     * Database manager.
     *
     * @var Manager
     */
    private $_manager;

    /**
     * Project instance.
     *
     * @var Project
     */
    private $_project;

    /**
     * Constructor.
     */
    public function __construct(Manager $manager, Project $project)
    {
        $this->_connections = [
            'data' => null,
            'system' => null,
        ];
        $this->_manager = $manager;
        $this->_project = $project;
    }

    /**
     * {@inheritdoc}
     */
    public function data(): ConnectionInterface
    {
        return $this->get(self::DATABASE_DATA);
    }

    /**
     * {@inheritdoc}
     */
    public function system(): ConnectionInterface
    {
        return $this->get(self::DATABASE_SYSTEM);
    }

    /**
     * Gets a connection by name in project config.
     */
    private function get($name): ConnectionInterface
    {
        $projectName = $this->_project->name();

        $connectionName = "${projectName}.${name}";
        if ($this->_connections[$name] === null) {
            $connections = $this->_manager->getDatabaseManager()->getConnections();
            if (!array_key_exists($connectionName, $connections)) {
                $this->_manager->addConnection($this->_project->config()->get("databases.${name}"), $connectionName);
            }
            $this->_connections[$name] = $this->_manager->getConnection($connectionName);
        }

        return $this->_connections[$name];
    }
}
