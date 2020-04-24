<?php

declare(strict_types=1);

namespace Directus\Services\Folders;

use Directus\Contracts\Services\Service;
use Directus\Database\System\Models\Folder;
use Directus\Exceptions\FolderNotFound;

class FoldersService implements Service
{
    public function all(): array
    {
        return Folder::all()->toArray();
    }

    /**
     * @throws FolderNotFound
     */
    public function find(string $key): array
    {
        return $this->findModel($key)->toArray();
    }

    /**
     * @throws FolderNotFound
     */
    public function create(array $attributes): array
    {
        $folder = new Folder();
        $folder->name = data_get($attributes, 'name');

        // TODO: check this parent_id (folder)
        if (isset($attributes['parent_folder'])) {
            $parent = $this->findModel(data_get($attributes, 'parent_folder'));
            $folder->parent()->associate($parent);
        }

        $folder->save();

        return $folder->toArray();
    }

    /**
     * @throws FolderNotFound
     */
    public function update(string $key, array $attributes): array
    {
        $folder = $this->findModel($key);

        // TODO: check this parent_id (folder)
        if (isset($attributes['parent_folder'])) {
            $parent = $this->findModel(data_get($attributes, 'parent_folder'));
            $folder->parent()->associate($parent);

            unset($attributes['parent_folder']);
        } else {
            if ($folder->parent_id !== null) {
                $folder->parent()->dissociate();
            }
        }

        $folder->update($attributes);

        return $folder->toArray();
    }

    /**
     * @throws FolderNotFound
     */
    public function delete(string $key): void
    {
        $folder = $this->findModel($key);

        $folder->folders()->delete();
        $folder->delete();
    }

    private function findModel(string $key): Folder
    {
        $folder = Folder::find($key);

        if ($folder === null) {
            throw new FolderNotFound($key);
        }

        return $folder;
    }
}
