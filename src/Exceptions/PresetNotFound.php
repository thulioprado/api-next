<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Exceptions\Traits\SmartException;
use Exception;

/**
 * Exception.
 */
class PresetNotFound extends Exception
{
    use SmartException;
}
