<?php

declare(strict_types=1);

namespace Directus\Core;

use Directus\Core\Config\Config;
use Directus\Core\Options\Options;

/**
 * Directus.
 */
final class Projects
{
    /**
     * Instantiated projects.
     *
     * @var array
     */
    private $projects;

    /**
     * Current working project.
     *
     * @var null|Project
     */
    private $current;

    /**
     * Directus SDK constructor.
     *
     * @param array $options
     */
    public function __construct($options)
    {
        $this->current = null;
        $this->projects = [];
    }

    /**
     * Gets a project by name.
     */
    public function hasProject(string $project): bool
    {
        return \array_key_exists($project, $this->projects);
    }

    public function getProject(string $project)
    {
        if (isset($this->projects[$project])) {
            if ($setAsCurrent) {
                $this->current = $this->projects[$project];
            }

            return $this->projects[$project];
        }

        $providerName = $this->options->get('config.provider');
        $providerArguments = $this->options->get('config.arguments');

        $provider = new $providerName(...$providerArguments);

        $config = new Config($project, $provider);

        $this->projects[$project] = new Project($config);
        if ($setAsCurrent) {
            $this->current = $this->projects[$project];
        }

        return $this->projects[$project];
    }
}
