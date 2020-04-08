<?php

declare(strict_types=1);

namespace Directus\Database\Migrations\Traits;

use Directus\Facades\Directus;
use Illuminate\Support\Str;

trait MigrateCollections
{
    protected function registerCollection(string $id, string $name): void
    {
        $system = Directus::databases()->system();
        $system->collection('collections')->builder()->insert([
            'id' => $id ?? (string) Str::uuid(),
            'name' => $system->collection($name)->fullName(),
            'system' => true,
        ]);
    }

    protected function unregisterCollection(string $name): void
    {
        $system = Directus::databases()->system();
        $system->collection('collections')->builder()->where([
            'name' => $system->collection($name)->fullName(),
        ]);
    }
}
