<?php

declare(strict_types=1);

namespace Directus\Framework\Projects;

use Directus\Framework\Contracts\Config as DirectusConfig;
use Directus\Framework\Contracts\Projects\Config as Config;
use Directus\Framework\Contracts\Projects\Project;
use Directus\Framework\Contracts\Projects\Repository as ProjectRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;
use Webmozart\PathUtil\Path;

/**
 * File repository.
 */
class DirectoryRepository implements ProjectRepository
{
    /**
     * Directory key.
     */
    public const CONFIG_DIRECTORY = 'project.repository.filesystem.directory';

    /**
     * @var DirectusConfig
     */
    private $_config;

    /**
     * @var Container
     */
    private $_container;

    /**
     * Constructor.
     */
    public function __construct(Container $container, DirectusConfig $config)
    {
        $this->_config = $config;
        $this->_container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function all(): Collection
    {
        return Collection::make(glob($this->getProjectFile('*')))->map(function ($file): Project {
            [ 'filename' => $name ] = pathinfo($file);

            return $this->project($name);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function project(string $name): Project
    {
        /** @var Config */
        $config = $this->_container->make(Config::class, [
            'name' => $name,
        ]);

        // @var Project
        return $this->_container->make(Project::class, [
            'config' => $config,
            'name' => $name,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function exists(string $name): bool
    {
        $file = $this->getProjectFile($name);

        return file_exists($file) && is_file($file) && is_readable($file);
    }

    /**
     * Gets a relative path within the root folder.
     */
    private function getProjectFile(string $name = ''): string
    {
        $root = $this->_config->get(self::CONFIG_DIRECTORY);

        return Path::join($root, "{$name}.php");
    }
}
