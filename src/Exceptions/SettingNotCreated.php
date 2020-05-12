<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Exceptions\Traits\SmartException;
use Exception;

/**
 * DirectusException.
 */
class SettingNotCreated extends Exception
{
    use SmartException;
}
