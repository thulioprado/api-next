<?php

declare(strict_types=1);

namespace Directus\Framework;

use Directus\Framework\Collections\Collection;
use Directus\Framework\Contracts\Collections\Collection as CollectionContract;
use Directus\Framework\Contracts\Databases\Connections as ConnectionsContract;
use Directus\Framework\Databases\Connections;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Config\Repository as RepositoryContract;
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
    private $instance;

    /**
     * Constructor.
     */
    private function __construct()
    {
        $this->instance = new Directus();
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
        $config = $this->withConfig();

        $data = Arr::dot($data);
        foreach ($data as $key => $value) {
            $config->set((string) $key, $value);
        }

        return $this;
    }

    /**
     * Loads configs from a file.
     */
    public function useConfiguration(array $data): self
    {
        $this->instance->singleton(RepositoryContract::class, function () use ($data): RepositoryContract {
            return new Repository($data);
        });

        return $this;
    }

    /**
     * Loads configs from a file.
     */
    public function useConfigurationFromFile(string $file): self
    {
        $this->instance->singleton(RepositoryContract::class, function () use ($file): RepositoryContract {
            return new Repository(require $file);
        });

        return $this;
    }

    /**
     * Configures directus to use an external database manager.
     */
    public function useDatabaseManager(Manager $manager): self
    {
        $this->instance->instance(Manager::class, $manager);

        return $this;
    }

    /**
     * Configures directus to manage it's own database connections.
     */
    public function useDefaultDatabaseManager(): self
    {
        $this->instance->singletonIf(Manager::class, function (): Manager {
            $config = $this->withConfig();
            $manager = new Manager();

            $connections = $config->get('databases.connections', []);
            foreach ($connections as $name => $data) {
                $manager->addConnection($data, $name);
            }

            return $manager;
        });

        return $this;
    }

    /**
     * Gets the built directus instance.
     */
    public function build(): Directus
    {
        $this->instance->bind(CollectionContract::class, Collection::class);
        $this->instance->singletonIf(RepositoryContract::class, Repository::class);

        if (!$this->instance->bound(Manager::class)) {
            $this->useDefaultDatabaseManager();
        }

        $this->instance->singletonIf(ConnectionsContract::class, Connections::class);

        return $this->instance;
    }

    /**
     * Uses the config contract.
     */
    private function withConfig(): RepositoryContract
    {
        $this->instance->singletonIf(RepositoryContract::class, Repository::class);

        return $this->instance->make(RepositoryContract::class);
    }
}
