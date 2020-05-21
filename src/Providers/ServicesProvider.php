<?php

declare(strict_types=1);

namespace Directus\Providers;

use Directus\Responses\Response;
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
     */
    public function register(): void
    {
        $this->app->bindIf(Response::class, Response::class);
        $this->app->bindIf(DatabasesService::class, DatabasesService::class);
        $this->app->bindIf(CollectionsService::class, CollectionsService::class);
        $this->app->bindIf(FieldsService::class, FieldsService::class);
        $this->app->bindIf(ActivitiesService::class, ActivitiesService::class);
        $this->app->bindIf(PresetsService::class, PresetsService::class);
    }
}
