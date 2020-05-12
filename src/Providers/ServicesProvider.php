<?php

declare(strict_types=1);

namespace Directus\Providers;

use Directus\Directus;
use Directus\Responses\DirectusResponse;
use Directus\Services\Activities\ActivitiesService;
use Directus\Services\Collections\CollectionsService;
use Directus\Services\Databases\DatabasesService;
use Directus\Services\Fields\FieldsService;
use Directus\Services\Presets\PresetsService;
use Illuminate\Support\ServiceProvider;

/**
 * Config provider.
 */
class ServicesProvider extends ServiceProvider
{
    /**
     * Service register.
     *
     * @noinspection StaticClosureCanBeUsedInspection
     */
    public function register(): void
    {
        $this->app->bindIf(DirectusResponse::class, DirectusResponse::class);
        Directus::macro('respond', function (): DirectusResponse {
            return resolve(DirectusResponse::class);
        });

        $this->app->bindIf(DatabasesService::class, DatabasesService::class);
        Directus::macro('databases', function (): DatabasesService {
            return resolve(DatabasesService::class);
        });

        $this->app->bindIf(CollectionsService::class, CollectionsService::class);
        Directus::macro('collections', function (): CollectionsService {
            return resolve(CollectionsService::class);
        });

        $this->app->bindIf(FieldsService::class, FieldsService::class);
        Directus::macro('fields', function (): FieldsService {
            return resolve(FieldsService::class);
        });

        $this->app->bindIf(ActivitiesService::class, ActivitiesService::class);
        Directus::macro('activities', function (): ActivitiesService {
            return resolve(ActivitiesService::class);
        });

        $this->app->bindIf(PresetsService::class, PresetsService::class);
        Directus::macro('presets', function (): PresetsService {
            return resolve(PresetsService::class);
        });
    }
}
