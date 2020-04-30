<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * Exception.
 */
class UserNotCreated extends DirectusException
{
    /**
     * Constructor.
     */
    public function __construct(array $attributes)
    {
        parent::__construct(Errors::USER_NOT_CREATED, $attributes);
    }
}
