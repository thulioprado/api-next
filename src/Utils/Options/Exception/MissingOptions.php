<?php

declare(strict_types=1);

namespace Directus\Utils\Options\Exception;

/**
 * Empty schema exception.
 */
class MissingOptions extends Options
{
    /**
     * Constructs the exception.
     */
    public function __construct(array $keys = [])
    {
        parent::__construct('Missing required options: '.implode(', ', $keys));
    }
}
