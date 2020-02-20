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
     */
    public function __construct()
    {
        $this->instance(self::class, $this);
        $this->alias(self::class, ContainerContract::class);
    }

    /**
     * Gets configs.
     */
    public function config(): ConfigRepositoryContract
    {
        // @var ConfigRepositoryContract
        return $this->resolve(ConfigRepositoryContract::class);
    }

    /**
     * Gets projects.
     */
    public function projects(): ProjectRepositoryContract
    {
        // @var ProjectRepositoryContract
        return $this->resolve(ProjectRepositoryContract::class);
    }
}
