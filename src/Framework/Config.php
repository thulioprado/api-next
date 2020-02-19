<?php

declare(strict_types=1);

namespace Directus\Framework;

use Illuminate\Config\Repository;
use Directus\Framework\Contracts\Config as ConfigContract;

/**
 * Config class.
 */
class Config extends Repository implements ConfigContract
{
}
