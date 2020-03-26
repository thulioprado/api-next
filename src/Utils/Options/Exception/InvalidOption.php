<?php

declare(strict_types=1);

namespace Directus\Utils\Options\Exception;

/**
 * Empty schema exception.
 */
class InvalidOption extends Options
{
    /**
     * Constructs the exception.
     */
    public function __construct(string $option)
    {
        parent::__construct("Invalid option value: {$option}");
    }
}
