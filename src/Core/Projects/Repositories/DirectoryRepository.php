<?php

declare(strict_types=1);

namespace Directus\Core\Projects\Repositories;

use Directus\Core\Options\Options;
use Directus\Core\Project;

/**
 * Directus project.
 */
final class DirectoryRepository implements RepositoryInterface
{
    /**
     * Options.
     *
     * @var Options
     */
    private $options;

    /**
     * Creates the directory provider.
     *
     * @param array $options
     */
    public function __construct($options)
    {
        $this->options = new Options([
            'path' => [
                Options::PROP_CONVERT => function ($value) {
                    $final = substr($value, -1);
                    if ($final !== '/' && $final !== '\\') {
                        $value .= \DIRECTORY_SEPARATOR;
                    }

                    return $value;
                },
            ],
        ], $options);
    }

    /**
     *  {@inheritdoc}
     */
    public function keys(): array
    {
        $files = scandir($this->options->get('path'));
        foreach ($files as $name => $file) {
            var_dump([$name, $file]);
        }

        return $files;
    }

    /**
     *  {@inheritdoc}
     */
    public function exists(string $name): bool
    {
        return false;
    }

    /**
     *  {@inheritdoc}
     */
    public function get(string $name): Project
    {
        throw new \Exception('Not implemented');
    }
}
