<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Exceptions\Traits\SmartException;
use Exception;

/**
 * Exception.
 */
class FileNotCreated extends Exception
{
    use SmartException;
}
