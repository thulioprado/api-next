<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * DirectusException.
 */
class CollectionNotFound extends DirectusException
{
    /**
     * DirectusException constructor.
     */
    public function __construct(string $key)
    {
        parent::__construct(Errors::COLLECTION_NOT_FOUND, [
            'key' => $key,
        ]);
    }
}
