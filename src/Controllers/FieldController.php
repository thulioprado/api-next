<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Field controller.
 */
class FieldController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query {
                    fields {
                        id
                        collection_id
                        name
                        type
                        interface
                        options
                        locked
                        validation
                        require
                        readonly
                        hidden_detail
                        hidden_browse
                        index
                        width
                        group_id
                        note
                        translation
                    }
                }
            ', $fields)
        );
    }

    public function allCollectionFields(string $collection): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [
            'collection_id' => $collection,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query CollectionFields($collection_id: String!) {
                    fields(collection_id: $collection_id) {
                        id
                        collection_id
                        name
                        type
                        interface
                        options
                        locked
                        validation
                        require
                        readonly
                        hidden_detail
                        hidden_browse
                        index
                        width
                        group_id
                        note
                        translation
                    }
                }
            ', $fields)
        );
    }

    public function fetchCollectionField(string $collection, string $key): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [
            'collection_id' => $collection,
            'id' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query CollectionField($id: String!, $collection_id: String!) {
                    field(id: $id, collection_id: $collection_id) {
                        id
                        collection_id
                        name
                        type
                        interface
                        options
                        locked
                        validation
                        require
                        readonly
                        hidden_detail
                        hidden_browse
                        index
                        width
                        group_id
                        note
                        translation
                    }
                }
            ', $fields)
        );
    }

    public function createCollectionField(string $collection): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = [
            'collection_id' => $collection,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query CreateCollectionField(
                    $collection_id: String!,
                    $name: String,
                    $type: String,
                    $interface: String,
                    $options: [String],
                    $locked: Boolean,
                    $validation: String,
                    $require: Boolean,
                    $readonly: Boolean,
                    $hidden_detail: Boolean,
                    $hidden_browse: Boolean,
                    $index: Int,
                    $width: String,
                    $group_id: String,
                    $note: String,
                    $translation: [String]
                ) {
                    createCollectionField(
                        collection_id: $collection_id,
                        name: $name,
                        type: $type,
                        interface: $interface,
                        options: $options,
                        locked: $locked,
                        validation: $validation,
                        require: $require,
                        readonly: $readonly,
                        hidden_detail: $hidden_detail,
                        hidden_browse: $hidden_browse,
                        index: $index,
                        width: $width,
                        group_id: $group_id,
                        note: $note,
                        translation: $translation
                    ) {
                        id
                        collection_id
                        name
                        type
                        interface
                        options
                        locked
                        validation
                        require
                        readonly
                        hidden_detail
                        hidden_browse
                        index
                        width
                        group_id
                        note
                        translation
                    }
                }
            ', $fields)
        );
    }

    public function updateCollectionField(string $collection, string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = [
            'collection_id' => $collection,
            'id' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                query UpdateCollectionField(
                    $id: String!,
                    $collection_id: String!,
                    $name: String,
                    $type: String,
                    $interface: String,
                    $options: [String],
                    $locked: Boolean,
                    $validation: String,
                    $require: Boolean,
                    $readonly: Boolean,
                    $hidden_detail: Boolean,
                    $hidden_browse: Boolean,
                    $index: Int,
                    $width: String,
                    $group_id: String,
                    $note: String,
                    $translation: [String]
                ) {
                    updateCollectionField(
                        id: $id,
                        collection_id: $collection_id,
                        name: $name,
                        type: $type,
                        interface: $interface,
                        options: $options,
                        locked: $locked,
                        validation: $validation,
                        require: $require,
                        readonly: $readonly,
                        hidden_detail: $hidden_detail,
                        hidden_browse: $hidden_browse,
                        index: $index,
                        width: $width,
                        group_id: $group_id,
                        note: $note,
                        translation: $translation
                    ) {
                        id
                        collection_id
                        name
                        type
                        interface
                        options
                        locked
                        validation
                        require
                        readonly
                        hidden_detail
                        hidden_browse
                        index
                        width
                        group_id
                        note
                        translation
                    }
                }
            ', $fields)
        );
    }

    public function deleteCollectionField(string $collection, string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = [
            'collection_id' => $collection,
            'id' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute(/* @lang GraphQL */ '
                mutation DeleteFolder($id: String!, $collection_id: String!) {
                    deleteFolder(id: $id, collection_id: $collection_id) {
                        id
                    }
                }
            ', $fields)
        );
    }
}
