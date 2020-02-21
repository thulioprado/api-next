<?php

declare(strict_types=1);

namespace Directus\Laravel\Providers;

use Directus\Framework\Builder;
use Directus\Framework\Contracts\Collections\Collection;
use Directus\Framework\Contracts\Projects\Project;
use Directus\Framework\Directus;
use Directus\Laravel\Contracts\Identifiers\Identifier as IdentifierContract;
use Directus\Laravel\Controllers\ProjectController;
use Directus\Laravel\Controllers\ServerController;
use Directus\Laravel\Identifiers\Middleware;
use Directus\Laravel\Identifiers\ParameterIdentifier;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
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
        $this->registerConfigs();
        $this->registerDependencies();
    }

    /**
     * Service boot.
     */
    public function boot(Router $router): void
    {
        $this->bootConfigs();
        $this->bootAdmin();
        $this->bootRoutes($router);
    }

    /**
     * Merges configuration.
     */
    private function registerConfigs(): void
    {
        // Do not load configs if it's cached.
        if ($this->app->configurationIsCached()) {
            return;
        }

        $this->mergeConfigFrom(
            __DIR__.'/../Config/directus.php',
            'directus'
        );

        $files = glob(config_path('projects/*.php'));
        if ($files === false) {
            return;
        }

        foreach ($files as $file) {
            [ 'filename' => $filename ] = pathinfo($file);
            $this->mergeConfigFrom(
                $file,
                "directus.projects.{$filename}"
            );
        }
    }

    /**
     * Register dependencies.
     */
    private function registerDependencies(): void
    {
        $this->app->singleton(Directus::class, function (): Directus {
            return Builder::create()
                ->loadConfigFromFile(config_path('directus.php'))
                // TODO: use config file to specify how projects will be loaded
                ->loadProjectsFromFiles(config_path('projects'))
                // TODO: use config file to specify how databases will be loaded
                ->loadDatabasesFromFile()
                ->get();
        });

        $this->app->singleton(IdentifierContract::class, function (): IdentifierContract {
            $provider = config('directus.identifier.provider', ParameterIdentifier::class);
            $parameters = config('directus.identifier.parameters', []);

            return new $provider(...$parameters);
        });

//        $this->app->bind(Project::class, function (): Project {
//            /** @var Directus */
//            $directus = resolve(Directus::class);
//
//            /** @var IdentifierContract */
//            $identifier = resolve(IdentifierContract::class);
//
//            $project = $identifier->project();
//            if ($project === null) {
//                throw new \Exception('Failed to resolve project.');
//            }
//
//            return $directus->projects()->project($project);
//        });
//
//        $this->app->bind(Collection::class, function (): Collection {
//            /** @var Project */
//            $project = resolve(Project::class);
//
//            /** @var IdentifierContract */
//            $identifier = resolve(IdentifierContract::class);
//
//            $collection = $identifier->collection();
//            if ($collection === null) {
//                throw new \Exception('Failed to resolve collection on a route without {collection} parameter.');
//            }
//
//            return $project->collection($collection);
//        });
    }

    /**
     * Config booting.
     */
    private function bootConfigs(): void
    {
        $this->publishes([
            __DIR__.'/../Config/directus.php' => config_path('directus.php'),
        ], ['directus', 'directus.config']);

        $this->publishes([
            __DIR__.'/../Config/projects/default.php' => config_path('projects/default.php'),
        ], ['directus', 'directus.config', 'directus.config.projects']);
    }

    /**
     * Service boot.
     */
    private function bootRoutes(Router $router): void
    {
        /** @var bool */
        $debug = config('directus.debug', false);

        // Do not create routes if it's cached.
        if ($this->app->routesAreCached() && !$debug) {
            return;
        }

        $base = config('directus.routes.base', '/');

        $router->middlewareGroup('directus', [
            Middleware::class,
        ]);

        // Directus base
        Route::group([
            'prefix' => $base,
        ], function (): void {
            // Server
            // https://docs.directus.io/api/server.html#server
            Route::group([
                'prefix' => 'server',
            ], function (): void {
                Route::get('info', [ServerController::class, 'info']);
                Route::get('ping', [ServerController::class, 'ping']);
                Route::get('projects', [ServerController::class, 'projects']);
            });

            // Project
            Route::group([
                'prefix' => '{project}',
                'middleware' => [
                    'directus',
                ],
            ], function (): void {
                // Collection
                Route::get('items/{collection}', [ProjectController::class, 'index']);
                Route::get('items/{collection}/{id}', [ProjectController::class, 'show']);
            });
        });
    }

    /**
     * Publishes admin files to public folder.
     */
    private function bootAdmin(): void
    {
        $location = __DIR__.'/../../../app/dist';
        if (file_exists($location) && is_dir($location)) {
            $this->publishes([
                $location => public_path(config('directus.routes.admin', '/admin')),
            ], ['directus', 'directus.admin']);
        }
    }
}
