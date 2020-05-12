<?php

declare(strict_types=1);

namespace Directus\Console;

use Directus\Database\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'directus:install
                            {--email=admin@example.com : The initial user email.}
                            {--password= : The initial user password.}
                            {--composer : Perform the composer project creation flow.}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Directus in the current application.';

    /**
     * @var array
     */
    protected $credentials = [
        'created' => false,
        'random' => true,
        'email' => 'admin@example.com',
        'password' => null,
    ];

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
        $steps[] = 'createUser';

        foreach ($steps as $step) /* @var Callable $step */{
            $callback = [$this, $step];
            if (\is_callable($callback)) {
                \call_user_func_array($callback, []);
            }
            usleep(100000);
        }

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

            if ($this->credentials['created']) {
                $this->info('    The admin account has been created. You can now access');
                $this->info('                it through the app interface');
                $this->info('');
                $this->info("       Email: {$this->credentials['email']}");
                if ($this->credentials['random']) {
                    $this->info("    Password: {$this->credentials['password']}");
                } else {
                    $this->info('    Password: <same as the one specified in the command>');
                }
            } else {
                $this->info('    The admin account couldn\'t be created since it seems');
                $this->info('     that there are some users in the database already.');
                $this->info('     If you\'re trying to reset the admin password, try');
                $this->info('        running the password reset command instead.');
            }

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
        $this->info('Installing database contents');

        $app = app();

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
            static function () use ($migrator, $repository): void {
                if (!$migrator->repositoryExists()) {
                    $repository->createRepository();
                }

                $migrator->run($migrator->paths(), [
                    'pretend' => false,
                    'step' => false,
                ]);
            }
        );
    }

    /**
     * Creates the initial user.
     */
    private function createUser(): void
    {
        if (User::query()->count() > 0) {
            $this->info('Database already has users. Skipping.');

            return;
        }

        /** @var string $email */
        $email = $this->option('email') !== false ? $this->option('email') : 'admin@example.com';

        /** @var string $password */
        $password = $this->option('password') !== null ? $this->option('password') : Str::random(16);

        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $user->saveOrFail();

        $this->credentials = [
            'created' => true,
            'random' => $this->option('password') === null,
            'email' => $email,
            'password' => $password,
        ];

        if ($this->credentials['random'] && $this->option('composer') === false) {
            $this->info("User with email '{$email}' has been created with password {$password}");
        }
    }

    /**
     * Asserts the database file exists.
     */
    private function assertDatabaseExists(): void
    {
        $this->info('Asserting database exists');
        @touch(database_path('database.sqlite'));
        @touch(database_path('directus.sqlite'));
    }

    /**
     * Configures the environment file.
     */
    private function configureEnvironment(): void
    {
        $this->info('Updating environment information');

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
        $this->info('Publishing files');

        $this->callSilent('vendor:publish', ['--tag' => 'directus']);
    }
}
