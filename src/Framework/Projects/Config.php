<?php

declare(strict_types=1);

namespace Directus\Framework\Projects;

use Illuminate\Config\Repository;
use Directus\Framework\Contracts\Projects\Config as ConfigContract;

/**
 * Config class.
 */
class Config extends Repository implements ConfigContract
{
}
