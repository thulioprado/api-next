<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Exceptions\Traits\SmartException;
use Exception;

/**
 * DirectusException.
 */
class CollectionNotFound extends Exception
{
    use SmartException;
}
