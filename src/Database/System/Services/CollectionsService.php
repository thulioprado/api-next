<?php

declare(strict_types=1);

namespace Directus\Database\System\Services;

use Directus\Contracts\Database\System\Services\CollectionsService as CollectionsServiceContract;
use Directus\Database\System\Models\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

class CollectionsService extends Service implements CollectionsServiceContract
{
    use Macroable;

    /**
     * {@inheritdoc}
     */
    public function getByName(string $name): Collection
    {
        $collection = Collection::where('name', '=', $name)->first();
        if ($collection === null) {
            throw new \RuntimeException("Collection not found: {$name}");
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function register(string $name, ?string $id = null): void
    {
        $collection = new Collection();
        $collection->id = $id ?? (string) Str::uuid();
        $collection->name = $name;
        $collection->system = true;
        $collection->save();
    }

    /**
     * {@inheritdoc}
     */
    public function unregister(string $id): void
    {
        Collection::where('collection_id', '=', $id)->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function all(): EloquentCollection
    {
        return Collection::all();
    }
}
