<?php

declare(strict_types=1);

namespace Directus\Console;

use Illuminate\Console\Command;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Events\Dispatcher;

class UpgradeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'directus:upgrade
                            {--rollback : Rollback the last upgrade}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Performs Directus upgrades or rollbacks by applying migrations to system tables.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $app = app();

        $rollback = (bool) $this->option('rollback');

        $repository = new DatabaseMigrationRepository(
            $app['db'],
            config('directus.databases.system.options.prefix', '').'migrations'
        );

        // Since we have our own migrations, this avoids triggering migration related events
        // inside to application code.
        $events = new Dispatcher();

        $migrator = new Migrator(
            $repository,
            $app['db'],
            $app['files'],
            $events
        );

        $migrator->setOutput($this->getOutput());
        $migrator->path(__DIR__.'/../../database/migrations');

        $migrator->usingConnection(
            directus()->databases()->system()->connectionName(),
            function () use ($migrator, $rollback): void {
                if (!$migrator->repositoryExists()) {
                    $this->warn('Is Directus installed? We couldn\'t find migrations table.');
                    $this->warn('Upgrades are only for existing Directus installations.');

                    return;
                }

                if ($rollback) {
                    $migrator->rollback($migrator->paths(), [
                        'pretend' => false,
                        'step' => false,
                    ]);
                } else {
                    $migrator->run($migrator->paths(), [
                        'pretend' => false,
                        'step' => false,
                    ]);
                }
            }
        );
    }
}
