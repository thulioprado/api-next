<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * Exception.
 */
class RelationNotFound extends DirectusException
{
    /**
     * Constructor.
     */
    public function __construct(string $id)
    {
        parent::__construct(Errors::RELATION_NOT_FOUND, [
            'id' => $id,
        ]);
    }
}
