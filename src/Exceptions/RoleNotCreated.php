<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * Exception.
 */
class RoleNotCreated extends DirectusException
{
    /**
     * Constructor.
     */
    public function __construct(array $attributes)
    {
        parent::__construct(Errors::ROLE_NOT_CREATED, $attributes);
    }
}
