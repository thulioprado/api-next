<?php

declare(strict_types=1);

namespace Directus\Framework\Projects;

use Directus\Framework\Contracts\Collections\Collection;
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
     * Constructor.
     */
    public function __construct(Container $container, Config $config, string $name)
    {
        $this->_name = $name;
        $this->_config = $config;
        $this->_container = $container;
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
        /** @var Collection */
        $collection = $this->_container->make(Collection::class, [
            'project' => $this,
            'name' => $name,
        ]);

        return $collection;
    }
}
