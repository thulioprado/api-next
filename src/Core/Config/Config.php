<?php

declare(strict_types=1);

namespace Directus\Core\Config;

use Directus\Core\Config\Providers\ProviderInterface;

/**
 * Config factory.
 */
class Config implements ConfigInterface
{
    /**
     * Project name.
     *
     * @var string
     */
    private $project;

    /**
     * Configuration provider instance.
     *
     * @var ProviderInterface
     */
    private $provider;

    /**
     * Creates a new configuration instance.
     */
    private function __construct(string $project, ProviderInterface $provider)
    {
        $this->project = $project;
        $this->provider = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function key(): string
    {
        return $this->project;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, $default = null)
    {
        return $this->provider->get("{$this->project}.{$key}", $default);
    }
}
