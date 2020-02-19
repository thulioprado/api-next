<?php

declare(strict_types=1);

namespace Directus\Framework;

use Directus\Framework\Contracts\Projects\Repository as ProjectRepositoryContract;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository as ConfigRepositoryContract;
use Illuminate\Contracts\Container\Container as ContainerContract;

/**
 * Directus.
 */
final class Directus extends Container
{
    /**
     * Directus constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = $config;
        $this->instance(Directus::class, $this);
        $this->alias(Directus::class, ContainerContract::class);
    }

    /**
     * Gets configs.
     */
    public function config(): ConfigRepositoryContract
    {
        /** @var ConfigRepositoryContract */
        $config = $this->resolve(ConfigRepositoryContract::class);

        return $config;
    }

    /**
     * Gets projects.
     */
    public function projects(): ProjectRepositoryContract
    {
        /** @var ProjectRepositoryContract */
        $projects = $this->resolve(ProjectRepositoryContract::class);

        return $projects;
    }
}
