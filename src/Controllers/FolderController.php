<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\Models\File;
use Directus\Database\Models\Folder;
use Directus\Exceptions\FolderNotCreated;
use Directus\Exceptions\FolderNotFound;
use Directus\Requests\FolderRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Folder controller.
 */
class FolderController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Collection $folders */
        $folders = Folder::with(['parent', 'children', 'files'])->get();

        return directus()->respond()->with($folders->toArray());
    }

    /**
     * @throws FolderNotFound
     */
    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Folder $folder */
        $folder = Folder::with(['parent', 'children', 'files'])->findOrFail($key);

        return directus()->respond()->with($folder->toArray());
    }

    /**
     * @throws FolderNotCreated|FolderNotFound
     */
    public function create(FolderRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $folder_id = directus()->databases()->system()->transaction(function () use ($attributes): string {
            /** @var Folder $folder */
            $folder = new Folder($attributes);
            $folder->saveOrFail();

            return $folder->id;
        });

        /** @var Folder $folder */
        $folder = Folder::with(['parent', 'children', 'files'])->findOrFail($folder_id);

        return directus()->respond()->with($folder->toArray());
    }

    /**
     * @throws FolderNotFound
     */
    public function update(string $key, FolderRequest $request): JsonResponse
    {
        /** @var Folder $folder */
        $folder = Folder::with(['parent', 'children', 'files'])->findOrFail($key);
        $folder->update($request->all());

        return directus()->respond()->with($folder->toArray());
    }

    /**
     * @throws FolderNotFound
     */
    public function delete(string $key): JsonResponse
    {
        /** @var Folder $folder */
        $folder = Folder::with(['children', 'files'])->findOrFail($key);

        /*
        TODO: delete files from children and current folder.

        $folders = $folder->children->toArray();

        File::whereIn('folder_id', $folders)->update([
            'folder_id' => null
        ]);*/

        $folder->files()->update([
            'folder_id' => null,
        ]);
        $folder->delete();

        return directus()->respond()->withNothing();
    }
}
