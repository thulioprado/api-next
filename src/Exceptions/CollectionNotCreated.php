<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Exceptions\Traits\SmartException;
use Exception;

/**
 * DirectusException.
 */
class CollectionNotCreated extends Exception
{
    use SmartException;
}
