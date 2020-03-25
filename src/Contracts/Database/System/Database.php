<?php

declare(strict_types=1);

namespace Directus\Contracts\Database\System;

use Directus\Contracts\Database\Database as BaseDatabase;
use Directus\Contracts\Database\System\Services\CollectionsService;
use Directus\Contracts\Database\System\Services\FieldsService;

/**
 * System database.
 */
interface Database extends BaseDatabase
{
    /**
     * Gets the collections service.
     */
    public function collections(): CollectionsService;

    /**
     * Gets the fields service.
     */
    public function fields(): FieldsService;
}
