<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * Exception.
 */
class ColumnNotFound extends DirectusException
{
    /**
     * Constructor.
     */
    public function __construct(string $name)
    {
        parent::__construct(Errors::COLUMN_NOT_FOUND, [
            'name' => $name,
        ]);
    }
}
