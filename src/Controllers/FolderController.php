<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\System\Models\Folder;
use Illuminate\Http\JsonResponse;

/**
 * Folder controller.
 */
class FolderController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->folders()->all()
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            directus()->folders()->find($key)
        );
    }

    public function create(): JsonResponse
    {
        $parent = request()->get('parent_folder', 'NULL');
        $input = request()->validate([
            'parent_folder' => 'nullable|exists:'.Folder::class.',id',
            'name' => 'required|string|unique:'.Folder::class.',name,NULL,id,parent_id,'.$parent,
        ]);

        return directus()->respond()->with(
            directus()->folders()->create($input)
        );
    }

    public function update(string $key): JsonResponse
    {
        $parent = request()->get('parent_folder', 'NULL');
        $input = request()->validate([
            'parent_folder' => 'nullable|exists:'.Folder::class.',id',
            'name' => 'required|string|unique:'.Folder::class.',name,'.$key.',id,parent_id,'.$parent,
        ]);

        return directus()->respond()->with(
            directus()->folders()->update($key, $input)
        );
    }

    public function delete(string $key): JsonResponse
    {
        directus()->folders()->delete($key);

        return directus()->respond()->withNothing();
    }
}
