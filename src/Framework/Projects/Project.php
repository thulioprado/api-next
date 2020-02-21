<?php

declare(strict_types=1);

namespace Directus\Framework\Projects;

use Directus\Framework\Contracts\Collections\Collection;
use Directus\Framework\Contracts\Databases\Connections;
use Directus\Framework\Contracts\Projects\Config;
use Directus\Framework\Contracts\Projects\Project as ProjectContract;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Traits\Macroable;

/**
 * Project class.
 */
class Project implements ProjectContract
{
    use Macroable;

    /**
     * @var Container
     */
    private $_container;

    /**
     * @var Config
     */
    private $_config;

    /**
     * @var string
     */
    private $_name;

    /**
     * @var Connections
     */
    private $_connections;

    /**
     * Constructor.
     */
    public function __construct(Container $container, Config $config, string $name)
    {
        $this->_name = $name;
        $this->_config = $config;
        $this->_container = $container;
        $this->_connections = $container->make(Connections::class, [
            'project' => $this,
        ]);
    }

    /**
     * Checks if project is private.
     */
    public function name(): string
    {
        return $this->_name;
    }

    /**
     * {@inheritdoc}
     */
    public function private(): bool
    {
        return $this->_config->get('private');
    }

    /**
     * {@inheritdoc}
     */
    public function collection(string $name): Collection
    {
        return $this->_container->make(Collection::class, [
            'project' => $this,
            'connection' => $this->connections()->data(),
            'name' => $name,
        ]);
    }

    /**
     * Gets the database connections.
     */
    public function connections(): Connections
    {
        return $this->_connections;
    }

    /**
     * {@inheritdoc}
     */
    public function config(): Config
    {
        return $this->_config;
    }
}
