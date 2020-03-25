<?php

declare(strict_types=1);

namespace Directus\Database\System;

use Directus\Contracts\Database\System\Database as SystemDatabase;
use Directus\Contracts\Database\System\Services\CollectionsService;
use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\Database as BaseDatabase;

class Database extends BaseDatabase implements SystemDatabase
{
    /**
     * Gets a database collection.
     */
    public function collections(): CollectionsService
    {
        return resolve(CollectionsService::class);
    }

    /**
     * Gets a database collection.
     */
    public function fields(): FieldsService
    {
        return resolve(FieldsService::class);
    }
}
