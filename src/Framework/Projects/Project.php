<?php

declare(strict_types=1);

namespace Directus\Framework\Projects;

use Directus\Framework\Contracts\Collections\Collection;
use Directus\Framework\Contracts\Projects\Config;
use Directus\Framework\Contracts\Projects\Project as ProjectContract;
use Illuminate\Container\Container;

/**
 * Project class.
 */
class Project implements ProjectContract
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var string
     */
    private $name;

    /**
     * Constructor.
     */
    public function __construct(Config $config, string $name)
    {
        $this->name = $name;
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function collection(string $name): Collection
    {
        /** @var Collection */
        $collection = $this->container->make(Collection::class, [
            'project' => $this,
            'name' => $name,
        ]);

        return $collection;
    }
}
