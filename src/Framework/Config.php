<?php

declare(strict_types=1);

namespace Directus\Framework;

use Directus\Framework\Contracts\Config as ConfigContract;
use Illuminate\Config\Repository;

/**
 * Config class.
 */
class Config extends Repository implements ConfigContract
{
}
