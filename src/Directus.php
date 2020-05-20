<?php

declare(strict_types=1);

namespace Directus;

use Directus\GraphQL\GraphQL;
use Directus\Responses\Response;
use Directus\Services\Activities\ActivitiesService;
use Directus\Services\Collections\CollectionsService;
use Directus\Services\Databases\DatabasesService;
use Directus\Services\Fields\FieldsService;
use Directus\Services\Presets\PresetsService;
use Illuminate\Support\Traits\Macroable;

/**
 * Directus main class.
 */
class Directus
{
    use Macroable;

    /**
     * Returns the current SDK version.
     */
    public function version(): string
    {
        return (string) config('directus.version');
    }

    /**
     * Gets a Directus response.
     */
    public function respond(): Response
    {
        return resolve(Response::class);
    }

    /**
     * Gets the fields service.
     */
    public function fields(): FieldsService
    {
        return resolve(FieldsService::class);
    }

    /**
     * Gets the activities service.
     */
    public function activities(): ActivitiesService
    {
        return resolve(ActivitiesService::class);
    }

    /**
     * Gets the presets service.
     */
    public function presets(): PresetsService
    {
        return resolve(PresetsService::class);
    }

    /**
     * Gets the databases service.
     */
    public function databases(): DatabasesService
    {
        return resolve(DatabasesService::class);
    }

    /**
     * Gets the collections service.
     */
    public function collections(): CollectionsService
    {
        return resolve(CollectionsService::class);
    }

    /**
     * Gets the GraphQL service.
     */
    public function graphql(): GraphQL
    {
        return resolve(GraphQL::class);
    }
}
