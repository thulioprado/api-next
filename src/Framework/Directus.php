<?php

declare(strict_types=1);

namespace Directus\Framework;

use Directus\Framework\Contracts\Collections\Collection;
use Directus\Framework\Contracts\Projects\Project;
use Directus\Framework\Contracts\Projects\Repository as ProjectRepository;
use Directus\Framework\Projects\Project as ProjectImpl;
use Directus\Framework\Collections\Collection as CollectionImpl;
use Directus\Framework\Contracts\Config as DirectusConfig;
use Directus\Framework\Contracts\Projects\Config as ProjectConfig;
use Directus\Framework\Projects\FileRepository;
use Directus\Framework\Config as DirectusConfigImpl;
use Directus\Framework\Projects\Config as ProjectConfigImpl;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Container\Container as ContainerContract;

/**
 * Directus.
 */
final class Directus extends Container
{
    /**
     * @var bool
     */
    private $initialized;

    /**
     * Directus SDK constructor.
     *
     * @param array|null $options
     */
    public function __construct()
    {
        $this->initialized = false;
    }

    /**
     * Asserts the container to be initialized.
     */
    private function assertInitialized(): void
    {
        if ($this->initialized) {
            return;
        }

        $this->initialize();
    }

    /**
     * Configure default dependencies.
     */
    private function initialize(): void
    {
        $this->singleton(Directus::class, function () {
            return $this;
        });
        $this->alias(Directus::class, ContainerContract::class);

        $this->bind(Project::class, ProjectImpl::class);
        $this->bind(Collection::class, CollectionImpl::class);

        $this->singletonIf(DirectusConfig::class, DirectusConfigImpl::class);
        $this->singletonIf(ProjectConfig::class, ProjectConfigImpl::class);

        $this->bindIf(ProjectRepository::class, FileRepository::class);

        $this->initialized = true;
    }

    /**
     * Gets configs.
     */
    public function config(): ConfigRepository
    {
        $this->assertInitialized();

        /** @var ConfigRepository */
        $config = $this->resolve(ConfigRepository::class);

        return $config;
    }

    /**
     * Gets projects.
     */
    public function projects(): ProjectRepository
    {
        $this->assertInitialized();

        /** @var ProjectRepository */
        $projects = $this->resolve(ProjectRepository::class);

        return $projects;
    }
}
