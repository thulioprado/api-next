<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * Exception.
 */
class RelationNotCreated extends DirectusException
{
    /**
     * Constructor.
     */
    public function __construct(array $attributes)
    {
        parent::__construct(Errors::RELATION_NOT_CREATED, $attributes);
    }
}
