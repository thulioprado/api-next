<?php

declare(strict_types=1);

namespace Directus\Services\Revisions;

use Directus\Contracts\Services\Service;
use Directus\Database\System\Models\Activity;
use Directus\Database\System\Models\Collection;
use Directus\Database\System\Models\Revision;
use Directus\Exceptions\ActivityNotFound;
use Directus\Exceptions\CollectionNotFound;
use Directus\Exceptions\RevisionNotFound;

class RevisionsService implements Service
{
    public function all(): array
    {
        return Revision::with(['activity', 'collection'])->get()->toArray();
    }

    /**
     * @throws RevisionNotFound
     */
    public function find(string $key): array
    {
        return $this->findModel($key)->toArray();
    }

    /**
     * @throws ActivityNotFound|CollectionNotFound
     */
    public function create(array $attributes): array
    {
        $revision = new Revision();

        $revision->item = data_get($attributes, 'item');
        $revision->data = data_get($attributes, 'data');
        $revision->delta = data_get($attributes, 'delta');
        $revision->parent_item = data_get($attributes, 'parent_item');

        if (isset($attributes['parent_changed'])) {
            $revision->parent_changed = data_get($attributes, 'parent_changed');
        }

        if (isset($attributes['activity_id'])) {
            $activity = $this->findActivity(data_get($attributes, 'activity_id'));
            $revision->activity()->associate($activity);
        }

        if (isset($attributes['collection_id'])) {
            $collection = $this->findCollection(data_get($attributes, 'collection_id'));
            $revision->collection()->associate($collection);
        }

        $revision->save();

        return $revision->toArray();
    }

    /**
     * @throws ActivityNotFound|CollectionNotFound|RevisionNotFound
     */
    public function update(string $key, array $attributes): array
    {
        $revision = $this->findModel($key);

        if (array_key_exists('activity_id', $attributes)) {
            $activity_id = data_get($attributes, 'activity_id');

            if ($revision->activity_id !== $activity_id) {
                $activity = $this->findActivity($activity_id);
                $revision->activity()->associate($activity);
            }

            unset($attributes['activity_id']);
        }

        if (array_key_exists('collection_id', $attributes)) {
            $collection_id = data_get($attributes, 'collection_id');

            if ($revision->collection_id !== $collection_id) {
                $collection = $this->findCollection($collection_id);
                $revision->collection()->associate($collection);
            }

            unset($attributes['collection_id']);
        }

        $revision->update($attributes);

        return $revision->toArray();
    }

    /**
     * @throws RevisionNotFound
     */
    public function delete(string $key): void
    {
        $revision = $this->findModel($key);
        $revision->delete();
    }

    private function findModel(string $key): Revision
    {
        $revision = Revision::with(['activity', 'collection'])->find($key);

        if ($revision === null) {
            throw new RevisionNotFound($key);
        }

        return $revision;
    }

    private function findActivity(string $key): Activity
    {
        $activity = Activity::find($key);

        if ($activity === null) {
            throw new ActivityNotFound($key);
        }

        return $activity;
    }

    private function findCollection(string $key): Collection
    {
        $collection = Collection::find($key);

        if ($collection === null) {
            throw new CollectionNotFound($key);
        }

        return $collection;
    }
}
