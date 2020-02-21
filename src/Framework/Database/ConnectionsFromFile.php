<?php

declare(strict_types=1);

namespace Directus\Framework\Database;

use Directus\Framework\Contracts\Config;
use Directus\Framework\Contracts\Databases\Connections as ConnectionsContract;
use Directus\Framework\Contracts\Projects\Project;
use Illuminate\Config\Repository;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\ConnectionInterface;

/**
 * Directus database manager.
 */
final class ConnectionsFromFile implements ConnectionsContract
{
    /**
     * Data name.
     */
    public const DATABASE_DATA = 'databases.data';

    /**
     * System name.
     */
    public const DATABASE_SYSTEM = 'databases.system';

    /**
     * System connection.
     *
     * @var array
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
     * Config repository.
     *
     * @var Config
     */
    private $_config;

    /**
     * Database connections repository.
     *
     * @var Repository
     */
    private $_data;

    /**
     * Constructor.
     */
    public function __construct(Manager $manager, Project $project, Config $config)
    {
        $this->_connections = [
            'data' => null,
            'system' => null,
        ];
        $this->_manager = $manager;
        $this->_project = $project;
        $this->_config = $config;
        $this->_data = new Repository(
            require $config->get('databases.filesystem.file.path')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function data(): ConnectionInterface
    {
        return $this->get($this->_project->config()->get(self::DATABASE_DATA));
    }

    /**
     * {@inheritdoc}
     */
    public function system(): ConnectionInterface
    {
        return $this->get($this->_project->config()->get(self::DATABASE_SYSTEM));
    }

    /**
     * Gets a connection by name in project config.
     */
    private function get(string $name): ConnectionInterface
    {
        $projectName = $this->_project->name();
        $connectionName = "{$projectName}.{$name}";
        $connectionKey = "{$this->_config->get('databases.filesystem.file.key')}";

        if (!\array_key_exists($name, $this->_connections) || $this->_connections[$name] === null) {
            $connections = $this->_manager->getDatabaseManager()->getConnections();
            if (!\array_key_exists($connectionName, $connections)) {
                $this->_manager->addConnection($this->_data->get($connectionKey)[$name], $connectionName);
            }
            $this->_connections[$name] = $this->_manager->getConnection($connectionName);
        }

        return $this->_connections[$name];
    }
}
