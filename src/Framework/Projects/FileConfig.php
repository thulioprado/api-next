<?php

declare(strict_types=1);

namespace Directus\Framework\Projects;

use Directus\Framework\Contracts\Config as DirectusConfigContract;
use Directus\Framework\Contracts\Projects\Config as ProjectConfigContract;
use Illuminate\Config\Repository as ConfigRepository;
use Webmozart\PathUtil\Path;

/**
 * File config.
 */
class FileConfig extends ConfigRepository implements ProjectConfigContract
{
    /**
     * Constructor.
     */
    public function __construct(DirectusConfigContract $config, string $name)
    {
        $root = $config->get(DirectoryRepository::CONFIG_DIRECTORY);
        $data = require Path::join($root, "{$name}.php");

        parent::__construct($data);
    }
}
