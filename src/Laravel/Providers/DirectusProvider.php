<?php

declare(strict_types=1);

namespace Directus\Laravel\Providers;

use Directus\Framework\Directus;
use Illuminate\Config\Repository;
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

        $this->app->singleton(Directus::class, function (): Directus {
            $directus = new Directus();
            $directus->singleton(Repository::class, function() {
                return config("directus");
            });
        });

        $this->app->bind(Project::class, function (): Project {
            /** @var Directus */
            $directus = resolve(Directus::class);

            /** @var IdentifierInterface */
            $identifier = resolve(IdentifierInterface::class);

            if (!$identifier->isIdentified() && $identifier->identify()) {
                $directus->setCurrentProject($identifier->getProject());
            }

            return $directus->getCurrentProject();
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
}
