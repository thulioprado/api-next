<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * Exception.
 */
class TableNotFound extends DirectusException
{
    /**
     * Constructor.
     */
    public function __construct(string $name)
    {
        parent::__construct(Errors::TABLE_NOT_FOUND, [
            'name' => $name,
        ]);
    }
}
