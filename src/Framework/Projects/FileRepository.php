<?php

declare(strict_types=1);

namespace Directus\Framework\Projects;

use Directus\Framework\Contracts\Projects\Project;
use Directus\Framework\Contracts\Config as DirectusConfig;
use Directus\Framework\Contracts\Projects\Config as ProjectConfig;
use Directus\Framework\Contracts\Projects\Repository as ProjectRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;

/**
 * File repository.
 */
class FileRepository implements ProjectRepository
{
    /**
     * @var Repository
     */
    private $config;

    /**
     * @var Container
     */
    private $container;

    /**
     * Constructor.
     */
    public function __construct(Container $container, DirectusConfig $config)
    {
        $this->container = $container;
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function all(): Collection
    {
        return Collection::make(glob($this->getPath('*.php')))->map(function ($file) {
            [ 'filename' => $name ] = pathinfo($file);

            return $this->project($name);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function project(string $name): Project
    {
        /** @var ProjectConfig */
        $projectConfig = $this->container->make(ProjectConfig::class, [
            'name' => $name,
        ]);

        /** @var Project */
        $project = $this->container->make(Project::class, [
            'config' => $projectConfig,
            'name' => $name,
        ]);

        return $project;
    }

    /**
     * {@inheritdoc}
     */
    public function exists(string $name): bool
    {
        $target = $this->getPath($name.'.php');

        return file_exists($target) && is_file($target) && is_readable($target);
    }

    /**
     * Gets a relative path within the root folder.
     */
    private function getPath(string $file = ''): string
    {
        $root = $this->config->get('repository.files.root');
        $end = substr($root, -1);
        if ($end !== '\\' && $end !== '/') {
            $root .= DIRECTORY_SEPARATOR;
        }

        return $root.$file;
    }
}
