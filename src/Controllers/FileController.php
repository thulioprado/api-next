<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * File controller.
 */
class FileController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        // TODO: insert data field

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query {
                    files {
                        id
                        storage
                        filename_disk
                        filename_download
                        title
                        type
                        uploaded_by_id
                        uploaded_on
                        charset
                        filesize
                        width
                        height
                        duration
                        embed
                        folder_id
                        description
                        location
                        tags
                        checksum
                        private_hash
                        metadata
                    }
                }
            ', $fields)
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [
            'id' => $key,
        ];

        // TODO: insert data field

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query File($id: String!) {
                    file(id: $id) {
                        id
                        storage
                        filename_disk
                        filename_download
                        title
                        type
                        uploaded_by_id
                        uploaded_on
                        charset
                        filesize
                        width
                        height
                        duration
                        embed
                        folder_id
                        description
                        location
                        tags
                        checksum
                        private_hash
                        metadata
                    }
                }
            ', $fields)
        );
    }

    public function create(): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = request()->all();

        // TODO: insert data field

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                mutation CreateFile(
                    $data: String!,
                    $filename_download: String,
                    $title: String,
                    $folder_id: String,
                    $description: String,
                    $location: String,
                    $tags: [String!],
                    $metadata: [String!]
                ) {
                    createFile(
                        data: $data,
                        filename_download: $filename_download,
                        title: $title,
                        folder_id: $folder_id,
                        description: $description,
                        location: $location,
                        tags: $tags,
                        metadata: $metadata
                    ) {
                        id
                        storage
                        filename_disk
                        filename_download
                        title
                        type
                        uploaded_by_id
                        uploaded_on
                        charset
                        filesize
                        width
                        height
                        duration
                        embed
                        folder_id
                        description
                        location
                        tags
                        checksum
                        private_hash
                        metadata
                    }
                }
            ', $fields)
        );
    }

    public function update(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = array_merge(request()->all(), [
            'id' => $key,
        ]);

        // TODO: insert data field

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                mutation UpdateFile(
                    $data: String!,
                    $filename_download: String,
                    $title: String,
                    $folder_id: String,
                    $description: String,
                    $location: String,
                    $tags: [String!],
                    $metadata: [String!]
                ) {
                    updateFile(
                        data: $data,
                        filename_download: $filename_download,
                        title: $title,
                        folder_id: $folder_id,
                        description: $description,
                        location: $location,
                        tags: $tags,
                        metadata: $metadata
                    ) {
                        id
                        storage
                        filename_disk
                        filename_download
                        title
                        type
                        uploaded_by_id
                        uploaded_on
                        charset
                        filesize
                        width
                        height
                        duration
                        embed
                        folder_id
                        description
                        location
                        tags
                        checksum
                        private_hash
                        metadata
                    }
                }
            ', $fields)
        );
    }

    public function delete(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = [
            'id' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                mutation DeleteFile($id: String!) {
                    deleteFile(id: $id) {
                        id
                    }
                }
            ', $fields)
        );
    }

    public function revisions(string $key, string $offset = null): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [
            'item' => $key,
            'offset' => $offset,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/** @lang GraphQL */ '
                query Revisions($item: String!, $offset: Int) {
                    revisions(item: $item, offset: $offset) {
                        id
                        activity_id
                        collection_id
                        item
                        data
                        delta
                        parent_collection_id
                        parent_item
                        parent_changed
                    }
                }
            ', $fields)
        );
    }
}
