<?php

declare(strict_types=1);

namespace Directus\Providers;

use Directus\Console\InstallCommand;
use Directus\Console\UpgradeCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Commands provider.
 */
class CommandsProvider extends ServiceProvider
{
    /**
     * @var array<string>
     */
    private $commands = [
        InstallCommand::class,
        UpgradeCommand::class,
    ];

    /**
     * Service boot.
     */
    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands($this->commands);
    }
}
