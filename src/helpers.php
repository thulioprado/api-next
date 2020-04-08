<?php

declare(strict_types=1);

use Directus\Directus;

if (!function_exists('directus')) {
    /**
     * Gets the directus instance.
     */
    function directus(): Directus
    {
        return app(Directus::class);
    }
}
