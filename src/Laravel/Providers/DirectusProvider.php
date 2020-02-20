<?php

declare(strict_types=1);

namespace Directus\Laravel\Providers;

use Directus\Framework\Builder;
use Directus\Framework\Contracts\Projects\Project;
use Directus\Framework\Directus;
use Directus\Laravel\Contracts\Identifiers\Identifier as IdentifierContract;
use Illuminate\Support\ServiceProvider;

/**
 * Directus provider.
 */
class DirectusProvider extends ServiceProvider
{
    /**
     * Service register.
     */
    public function register(): void
    {
        $this->configure();

        $this->app->singleton(Directus::class, function (): Directus {
            return Builder::create()->get();
        });

        $this->app->singleton(IdentifierContract::class, function (): IdentifierContract {
            $provider = config('directus.identifier.provider');
            $parameters = config('directus.identifier.parameters');

            /** @var IdentifierContract */
            $identifier = new $provider(...$parameters);

            return $identifier;
        });

        $this->app->bind(Project::class, function (): Project {
            /** @var Directus */
            $directus = resolve(Directus::class);

            /** @var DirectusIdentifierContract */
            $identifier = resolve(IdentifierContract::class);

            if (!$identifier->identified() && !$identifier->identify()) {
                throw new \Exception('Unable to identify working project.');
            }

            return $directus->projects()->project($identifier->get());
        });
    }

    /**
     * Service boot.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../Config/directus.php' => config_path('directus.php'),
        ], ['directus', 'directus.config']);

        $this->publishes([
            __DIR__.'/../Config/projects/default.php' => config_path('projects/default.php'),
        ], ['directus', 'directus.config', 'directus.config.projects']);
    }

    /**
     * Merges configuration.
     */
    private function configure(): void
    {
        if (!$this->app->configurationIsCached()) {
            $this->mergeConfigFrom(
                __DIR__.'/../Config/directus.php',
                'directus'
            );

            $files = glob(config_path('projects/*.php'));
            foreach ($files as $file) {
                [ 'filename' => $filename ] = pathinfo($file);
                $this->mergeConfigFrom(
                    $file, "directus.projects.${filename}"
                );
            }
        }
    }
}
