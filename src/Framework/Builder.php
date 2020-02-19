<?php

declare(strict_types=1);

namespace Directus\Framework;

use Directus\Framework\Projects\FilesystemRepository;
use Directus\Framework\Collections\Collection;
use Directus\Framework\Contracts\Collections\Collection as CollectionContract;
use Directus\Framework\Contracts\Config as ConfigContract;
use Directus\Framework\Contracts\Projects\Config as ProjectConfigContract;
use Directus\Framework\Contracts\Projects\Project as ProjectContract;
use Directus\Framework\Contracts\Projects\Repository as ProjectRepositoryContract;
use Directus\Framework\Exception\InitializationException;
use Directus\Framework\Projects\FilesystemConfig;
use Directus\Framework\Projects\Project;
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
     *
     * @return Builder
     */
    public static function create(): Builder
    {
        return new Builder();
    }

    /**
     * Statically configure the directus instance.
     */
    public function mergeConfig(array $data): Builder
    {
        $data = Arr::dot($data);
        foreach ($data as $key => $value) {
            $config->set($key, $value);
        }

        return $this;
    }

    /**
     * Loads configs from a file.
     */
    public function loadConfigFromFile(string $file): Builder
    {
        $this->directus->singleton(ConfigContract::class, function () use ($file): ConfigContract {
            return new Config(require $file);
        });

        return $this;
    }

    /**
     * Loads configs from a file.
     */
    public function loadProjectsFromFiles(string $directory): Builder
    {
        $this->useConfig()->set(FilesystemRepository::CONFIG_DIRECTORY, $directory);

        $this->directus->singleton(ProjectConfigContract::class, FilesystemConfig::class);
        $this->directus->bind(ProjectRepositoryContract::class, FilesystemRepository::class);

        return $this;
    }

    /**
     * Gets the built directus instance.
     *
     * @return Directus
     */
    public function get(): Directus
    {
        // Base classes
        $this->directus->bind(ProjectContract::class, Project::class);
        $this->directus->bind(CollectionContract::class, Collection::class);

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

        /** @var ConfigContract */
        $config = $this->directus->make(ConfigContract::class);

        return $config;
    }
}
