<?php

declare(strict_types=1);

namespace Directus\Services\Presets;

use Directus\Contracts\Services\Service;
use Directus\Database\Models\Preset;
use Directus\Exceptions\PresetNotFound;

class PresetsService implements Service
{
    public function all(): array
    {
        return Preset::all()->toArray();
    }

    /**
     * @throws PresetNotFound
     */
    public function find(string $key): array
    {
        return $this->findModel($key)->toArray();
    }

    public function create(string $collection, array $attributes): array
    {
        $collection_id = directus()->collections()->find($collection)['id'];

        // TODO: validate parameters
        $preset = new Preset();
        $preset->title = data_get($attributes, 'title', null);

        // TODO: use relationships to set column
        $preset->collection_id = $collection_id;

        // TODO: associate user and role when both services are implemented
        //       // $preset->user_id = data_get($attributes, 'user', null);
        //       // $preset->role_id = data_get($attributes, 'role', null);

        $preset->search_query = data_get($attributes, 'search_query', null);
        $preset->filters = data_get($attributes, 'filters', null);
        if (isset($attributes['view_type'])) {
            $preset->view_type = data_get($attributes, 'view_type');
        }
        $preset->view_query = data_get($attributes, 'view_query', null);
        $preset->view_options = data_get($attributes, 'view_options', null);
        $preset->translation = data_get($attributes, 'translation', null);

        $preset->save();

        return $preset->toArray();
    }

    /**
     * @throws PresetNotFound
     */
    public function update(string $key, array $attributes): array
    {
        // TODO: this is a mess, check a way to properly handle things like this
        $collection_id = directus()->collections()->find($attributes['collection'])['id'];
        $attributes['collection_id'] = $collection_id;
        unset($attributes['collection']);

        // TODO: associate user and role when both services are implemented
        //       use 'user_id' and 'role_id'

        $preset = $this->findModel($key);
        $preset->update($attributes);

        return $preset->toArray();
    }

    /**
     * @throws PresetNotFound
     */
    public function delete(string $key): void
    {
        $preset = $this->findModel($key);
        $preset->delete();
    }

    private function findModel(string $key): Preset
    {
        $preset = Preset::find($key);
        if ($preset === null) {
            throw new PresetNotFound();
        }

        return $preset;
    }
}
