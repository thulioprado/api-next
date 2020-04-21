<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * Exception.
 */
class RoleNotFound extends DirectusException
{
    /**
     * Constructor.
     */
    public function __construct(string $id)
    {
        parent::__construct(Errors::ROLE_NOT_FOUND, [
            'id' => $id,
        ]);
    }
}
