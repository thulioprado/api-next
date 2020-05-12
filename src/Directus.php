<?php

declare(strict_types=1);

namespace Directus;

use Directus\GraphQL\Runner;
use Directus\Responses\DirectusResponse;
use Directus\Services\Activities\ActivitiesService;
use Directus\Services\Collections\CollectionsService;
use Directus\Services\Databases\DatabasesService;
use Directus\Services\Fields\FieldsService;
use Directus\Services\Presets\PresetsService;
use Illuminate\Support\Traits\Macroable;

/**
 * Directus main class.
 *
 * @method static DirectusResponse respond(string $context = '')
 * @method static CollectionsService collections()
 * @method static FieldsService fields()
 * @method static DatabasesService databases()
 * @method static ActivitiesService activities()
 * @method static PresetsService presets()
 * @method static Runner graphql()
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
}
