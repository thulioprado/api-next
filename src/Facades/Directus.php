<?php

declare(strict_types=1);

namespace Directus\Facades;

use Directus\Directus as DirectusRoot;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin DirectusRoot
 */
class Directus extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return DirectusRoot::class;
    }
}
