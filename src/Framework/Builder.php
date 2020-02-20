<?php

declare(strict_types=1);

namespace Directus\Framework;

use Directus\Framework\Collections\Collection;
use Directus\Framework\Contracts\Collections\Collection as CollectionContract;
use Directus\Framework\Contracts\Config as ConfigContract;
use Directus\Framework\Contracts\Databases\Connections;
use Directus\Framework\Contracts\Projects\Config as ProjectConfigContract;
use Directus\Framework\Contracts\Projects\Project as ProjectContract;
use Directus\Framework\Contracts\Projects\Repository as ProjectRepositoryContract;
use Directus\Framework\Database\ConnectionsFromProjectConfig;
use Directus\Framework\Exception\InitializationException;
use Directus\Framework\Projects\FilesystemConfig;
use Directus\Framework\Projects\FilesystemRepository;
use Directus\Framework\Projects\Project;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Arr;

/**
 * Directus.
 */
final class Builder
{
    /**
     * Directus instance.
     *
     * @var Directus
     */
    private $directus;

    /**
     * Constructor.
     */
    private function __construct()
    {
        $this->directus = new Directus();
    }

    /**
     * Creates a new builder.
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * Statically configure the directus instance.
     */
    public function mergeConfig(array $data): self
    {
        $config = $this->useConfig();

        $data = Arr::dot($data);
        foreach ($data as $key => $value) {
            $config->set((string) $key, $value);
        }

        return $this;
    }

    /**
     * Loads configs from a file.
     */
    public function loadConfigFromFile(string $file): self
    {
        $this->directus->singleton(ConfigContract::class, function () use ($file): ConfigContract {
            return new Config(require $file);
        });

        return $this;
    }

    /**
     * Loads configs from a file.
     */
    public function loadProjectsFromFiles(string $directory): self
    {
        $this->useConfig()->set(FilesystemRepository::CONFIG_DIRECTORY, $directory);

        $this->directus->singleton(ProjectConfigContract::class, FilesystemConfig::class);
        $this->directus->bind(ProjectRepositoryContract::class, FilesystemRepository::class);

        return $this;
    }

    /**
     * Loads database information based on project's configuration.
     */
    public function loadDatabasesFromProjectConfig(): self
    {
        $this->directus->bind(Connections::class, ConnectionsFromProjectConfig::class);

        return $this;
    }

    /**
     * Gets the built directus instance.
     */
    public function get(): Directus
    {
        // Base classes
        $this->directus->bind(ProjectContract::class, Project::class);
        $this->directus->bind(CollectionContract::class, Collection::class);

        // Database
        $this->directus->singleton(Manager::class, Manager::class);

        // Config
        $this->directus->singletonIf(ConfigContract::class, Config::class);

        // Check bounds
        $verifyBounded = [
            ProjectConfigContract::class,
            ProjectRepositoryContract::class,
        ];

        foreach ($verifyBounded as $abstract) {
            if (!$this->directus->bound($abstract)) {
                throw new InitializationException("Missing {$abstract} setup.");
            }
        }

        return $this->directus;
    }

    /**
     * Uses the config contract.
     */
    private function useConfig(): ConfigContract
    {
        $this->directus->singletonIf(ConfigContract::class, Config::class);

        // @var ConfigContract
        return $this->directus->make(ConfigContract::class);
    }
}
