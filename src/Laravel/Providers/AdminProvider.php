<?php

declare(strict_types=1);

namespace Directus\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Admin provider.
 */
final class AdminProvider extends ServiceProvider
{
    /**
     * Publishes admin files to public folder.
     */
    public function boot(): void
    {
        $location = __DIR__.'/../../../app/dist';
        if (file_exists($location) && is_dir($location)) {
            $this->publishes([
                $location => public_path(config('directus.routes.admin', '/admin')),
            ], ['directus', 'directus.admin']);
        }
    }
}
