<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Exceptions\Traits\SmartException;
use Exception;

class SchemaFileNotFound extends Exception
{
    use SmartException;
}
