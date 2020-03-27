<?php

declare(strict_types=1);

namespace Directus\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

/**
 * Routes provider.
 */
class RoutesProvider extends ServiceProvider
{
    /**
     * Service boot.
     */
    public function boot(): void
    {
        /** @var bool $debug */
        $debug = config('app.debug', false);

        // Do not create routes if it's cached.
        // TODO: check whenever `App::` can be replaced with `$this->app->`
        // in https://github.com/nunomaduro/larastan/issues/483
        if (!$debug && App::routesAreCached()) {
            return;
        }

        $this->loadRoutesFrom(__DIR__.'/../../routes/directus.php');
    }
}
