<?php

declare(strict_types=1);

namespace Directus\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'directus:install
                            {--composer : Perform the composer project creation flow.}
                            {--force : Forces the installation even if its already installed.}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Directus in the current application.';

    /**
     * @var ProgressBar
     */
    protected $progress;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $steps = [];

        $composer = (bool) $this->option('composer');
        if ($composer) {
            $steps[] = 'assertDatabaseExists';
            $steps[] = 'configureEnvironment';
            $steps[] = 'publishFiles';
        }

        $steps[] = 'installDatabase';

        $this->progress = $this->output->createProgressBar(\count($steps));
        $this->progress->start();

        foreach ($steps as $step) /* @var Callable $step */{
            $callback = [$this, $step];
            if (\is_callable($callback)) {
                \call_user_func_array($callback, []);
            }
            $this->progress->advance();
            usleep(100000);
        }

        $this->progress->finish();
        $this->progress->clear();

        if ($composer) {
            $this->info('~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');
            $this->info('');
            $this->info('                          .cxxkkkxxdol:;-.');
            $this->info('                          .:KMMMMMMMMMMWNKko:.');
            $this->info('                          ,kNMMMMMMMMMWNNMMMWXOl-');
            $this->info('               ,l,         .;ldxkkOkdo::OMMMMMMMNk:.');
            $this->info('              -0MNkl;-...              cNMMMMMMMMMW0c.');
            $this->info('              .oXWMMWNXK0Okxol:-...  .cKMMMMMMMMMMMNx.');
            $this->info('                lNMMMMMMMMMMMMMWNX0OOKWMMMMMMNOool:-');
            $this->info('               .OMMMMMMMMMMMMMMMMMMMMMMMMMMMWo');
            $this->info('               lWMMMMMMMMMMMMMMMMMMMMMMMMMMMX;');
            $this->info('             .lXMMMMMMMWXKXWMMMMMMMMMMMMMMMMNd;-..');
            $this->info('          :x0XWMMMMMMNk:...,cdONWMMMMMMMMMMMMMWNX0ko;.');
            $this->info('         :NMMMNK0Oxoc-         -;:dOKNWWMMMMMMWNXXNWWKl.');
            $this->info('        ;KMW0c-..                   .-,,;clll:,...-cOWWx.');
            $this->info('      .lXMXo.                                       .,:-');
            $this->info('     -ONKd-');
            $this->info('     .--.');
            $this->info('');
            $this->info('~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');
            $this->info('                    Welcome to Directus!');
            $this->info('           Your Directus project has been created!');
            $this->info('   Run `php artisan serve` to start the development server.');
            $this->info('~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');
        } else {
            $this->info('Installation complete.');
        }
    }

    /**
     * Install the database data.
     */
    private function installDatabase(): void
    {
        $this->progress->setMessage('Installing database contents');
        $this->callSilent('migrate');
    }

    /**
     * Asserts the database file exists.
     */
    private function assertDatabaseExists(): void
    {
        $this->progress->setMessage('Asserting database exists');
        @touch(database_path('database.sqlite'));
    }

    /**
     * Configures the environment file.
     */
    private function configureEnvironment(): void
    {
        $this->progress->setMessage('Updating environment information');

        $env = base_path('.env');
        if (!file_exists($env)) {
            if (file_exists($env.'.example')) {
                file_put_contents($env, file_get_contents("{$env}.example"));
            } else {
                return;
            }
        }

        $contents = (string) file_get_contents($env);
        $contents = preg_replace('/DB_CONNECTION=.*/', 'DB_CONNECTION=sqlite', $contents);
        $contents = preg_replace('/DB_DATABASE=/', '# DB_DATABASE=', (string) $contents);

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        putenv('DB_CONNECTION=sqlite');
        putenv('DB_DATABASE');

        file_put_contents($env, $contents);
    }

    /**
     * Publishes Directus package contents.
     */
    private function publishFiles(): void
    {
        $this->progress->setMessage('Publishing files');

        $this->callSilent('vendor:publish', ['--tag' => 'directus']);
    }
}
