<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * Exception.
 */
class RevisionNotFound extends DirectusException
{
    /**
     * Constructor.
     */
    public function __construct(string $id)
    {
        parent::__construct(Errors::REVISION_NOT_FOUND, [
            'id' => $id,
        ]);
    }
}
