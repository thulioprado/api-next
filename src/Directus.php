<?php

declare(strict_types=1);

namespace Directus;

use Directus\Responses\DirectusResponse;
use Directus\Services\Collections\CollectionsService;
use Directus\Services\Databases\DatabasesService;
use Directus\Services\Fields\FieldsService;
use Illuminate\Support\Traits\Macroable;

/**
 * Directus.
 *
 * @method static DirectusResponse respond()
 * @method static CollectionsService collections()
 * @method static FieldsService fields()
 * @method static DatabasesService databases()
 */
class Directus
{
    use Macroable;
}
