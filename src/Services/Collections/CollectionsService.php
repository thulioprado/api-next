<?php

declare(strict_types=1);

namespace Directus\Services\Collections;

use Directus\Contracts\Services\Service;
use Directus\Database\Models\Collection;
use Directus\Exceptions\CollectionNotFound;

class CollectionsService implements Service
{
    public function all(): array
    {
        return Collection::with('fields')->get()->toArray();
    }

    /**
     * @param string $key the `id` or `name` of the collection
     *
     * @throws CollectionNotFound
     */
    public function find(string $key): array
    {
        return $this->findModel($key)->toArray();
    }

    public function create(array $options): array
    {
        // TODO: validate options
        $collection = new Collection($options);
        $collection->save();

        return $collection->load('fields')->toArray();
    }

    /**
     * @throws CollectionNotFound
     */
    public function update(string $key, array $options): array
    {
        $collection = $this->findModel($key);
        $collection->update($options);

        return $collection->load('fields')->toArray();
    }

    /**
     * @throws CollectionNotFound
     */
    public function delete(string $key): void
    {
        $this->findModel($key)->delete();
    }

    /**
     * @throws CollectionNotFound
     */
    private function findModel(string $key): Collection
    {
        $collection = Collection::with('fields')
            ->orWhere('id', '=', $key)
            ->orWhere('name', '=', $key)
            ->first()
        ;

        if ($collection === null) {
            throw new CollectionNotFound($key);
        }

        return $collection;
    }
}
