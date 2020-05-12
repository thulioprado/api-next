<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Exceptions\Traits\SmartException;
use Exception;

/**
 * Exception.
 */
class ActivityNotCreated extends Exception
{
    use SmartException;
}
