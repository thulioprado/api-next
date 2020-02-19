<?php

declare(strict_types=1);

namespace Directus\Core;

use Directus\Core\Projects\Repositories\DirectoryRepository;
use Directus\Core\Projects\Repositories\RepositoryInterface;
use Illuminate\Container\Container;

/**
 * Directus.
 */
final class Directus
{
    /**
     * Service container instance.
     *
     * @var Container
     */
    private $container;

    /**
     * Directus SDK constructor.
     *
     * @param array $options
     */
    public function __construct()
    {
        $this->container = new Container();
        $this->container->bind(RepositoryInterface::class, DirectoryRepository::class);
    }

    /**
     * Gets the project repository.
     */
    public function getProjectRepository(): RepositoryInterface
    {
        /** @var RepositoryInterface */
        $repository = $this->container->resolve(RepositoryInterface::class);

        return $repository;
    }

    /**
     * Service container.
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
