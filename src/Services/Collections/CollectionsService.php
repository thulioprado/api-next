<?php

declare(strict_types=1);

namespace Directus\Services\Collections;

use Directus\Contracts\Services\Service;
use Directus\Database\System\Models\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Str;

class CollectionsService implements Service
{
    public function getByName(string $name): Collection
    {
        $collection = Collection::where('name', '=', $name)->first();
        if ($collection === null) {
            throw new \RuntimeException("Collection not found: {$name}");
        }

        return $collection;
    }

    public function register(string $name, ?string $id = null): void
    {
        $collection = new Collection();
        $collection->id = $id ?? (string) Str::uuid();
        $collection->name = $name;
        $collection->system = true;
        $collection->save();
    }

    public function unregister(string $id): void
    {
        Collection::where('collection_id', '=', $id)->delete();
    }

    public function all(): EloquentCollection
    {
        return Collection::all();
    }
}