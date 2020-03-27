<?php

declare(strict_types=1);

namespace Directus\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'directus:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Directus files into the application.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->callSilent('vendor:publish', ['--tag' => 'directus-config']);
        $this->info('Installation complete.');
    }
}
