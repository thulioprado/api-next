<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;

/**
 * Collection controller.
 */
class CollectionController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            $this->transformCollections(
                directus()->collections()->all()
            )
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        return directus()->respond()->with(
            $this->transformCollection(
                directus()->collections()->find($key)
            )
        );
    }

    // TODO: review this, should we split database actions into /schema endpoints? this is doing too much stuff at once
    public function create(): JsonResponse
    {
        // TODO: validate post parameters properly

        $input = request()->validate([
            'name' => 'required|string',
            'collection' => 'string',
            'note' => 'string',
            'hidden' => 'boolean',
            'single' => 'boolean',
            'icon' => 'string',
            'translation' => 'array',
            'fields' => 'required|array',
            'fields.*.name' => 'required|string|distinct',
            'fields.*.field' => 'string|distinct',
            'fields.*.type' => 'required|string',
            'fields.*.datatype' => 'string',
            'fields.*.unique' => 'boolean',
            'fields.*.primary_key' => 'boolean',
            'fields.*.auto_increment' => 'boolean',
            'fields.*.note' => 'string',
            'fields.*.signed' => 'boolean',
            'fields.*.index' => 'numeric',
            'fields.*.sort' => 'numeric',
            'fields.*.interface' => 'string',
            'fields.*.hidden_detail' => 'boolean',
            'fields.*.hidden_browse' => 'boolean',
            'fields.*.options' => 'array',
            'fields.*.locked' => 'boolean',
            'fields.*.translation' => 'array',
            'fields.*.readonly' => 'boolean',
            'fields.*.width' => 'string', // TODO: could be a regex
            'fields.*.validation' => 'string|regex:/\/.*\/\w*/',
            'fields.*.group_id' => 'string',
            'fields.*.length' => 'numeric',
        ]);

        // TODO: remove - for backwards compatibility only
        if (isset($input['collection'])) {
            $input['name'] = $input['collection'];
            unset($input['collection']);
        }

        // TODO: remove - for backwards compatibility only
        foreach ($input['fields'] as &$field) {
            if (isset($field['field'])) {
                $field['name'] = $field['field'];
                unset($field['field']);
            }
            if (isset($field['sort'])) {
                $field['index'] = $field['sort'];
                unset($field['sort']);
            }
        }

        unset($field);

        $fields = data_get($input, 'fields', []);

        // TODO: throw if no primary keys? throw if multiple primary keys?
        //       // $primaryKeys = collect($fields)->where('primary_key', true);

        /** @var string $id */
        $id = directus()->databases()->transaction(static function () use ($input, $fields) {
            // TODO: create table and columns with schema service

            $collection = directus()->collections()->create([
                'name' => data_get($input, 'name'),
                'hidden' => data_get($input, 'hidden', false),
                'single' => data_get($input, 'single', false),
                'system' => data_get($input, 'system', false),
                'icon' => data_get($input, 'icon', null),
                'note' => data_get($input, 'note', null),
                'translation' => data_get($input, 'translation', null),
            ]);

            $fieldsService = directus()->fields();

            foreach ($fields as $field) {
                $inserted = $fieldsService->insert(Uuid::uuid4()->toString());
                $inserted->name(data_get($field, 'name'))
                    ->collection_id($collection['id'])
                    ->type(data_get($field, 'type'))
                    ->interface(data_get($field, 'interface'))
                    ->options(data_get($field, 'options', []))
                    ->locked(data_get($field, 'locked', false))
                    ->note(data_get($field, 'note', null))
                    ->hidden_browse(data_get($field, 'hidden_browse', false))
                    ->hidden_detail(data_get($field, 'hidden_detail', false))
                    ->translate(data_get($field, 'translation', null))
                    ->readonly(data_get($field, 'readonly', false))
                    ->width(data_get($field, 'width', 'full'))
                    ->validation(data_get($field, 'validation', null))
                    ->group_id(data_get($field, 'group_id', null))
                ;

                if (isset($field['index'])) {
                    $inserted->index(data_get($field, 'index', null));
                }

                // ->datatype(data_get($field, 'datatype'))
                // ->unique(data_get($field, 'unique', false))
                // ->primary_key(data_get($field, 'primary_key', false))
                // ->auto_increment(data_get($field, 'auto_increment', false))
                // ->signed(data_get($field, 'signed', true))
                // ->length(data_get($field, 'length', null))
            }

            $fieldsService->save();

            return $collection['id'];
        });

        return directus()->respond()->with(
            directus()->collections()->find($id)
        );
    }

    public function update(string $key): JsonResponse
    {
        $input = request()->validate([
            'name' => 'string',
            'collection' => 'string',
            'note' => 'string',
            'hidden' => 'boolean',
            'single' => 'boolean',
            'icon' => 'string',
            'translation' => 'array',
        ]);

        directus()->databases()->transaction(function () use ($input, $key): void {
            // TODO: also rename table if name changes
            directus()->collections()->update($key, $input);
        });

        return directus()->respond()->with(
            $this->transformCollection(
                directus()->collections()->find($key)
            )
        );
    }

    public function delete(string $key): JsonResponse
    {
        directus()->databases()->transaction(function () use ($key): void {
            directus()->collections()->delete($key);
        });

        return directus()->respond()->withNothing();
    }

    // TODO: implement some kind of response transformer to allow this kind of stuff below to be implemented elsewhere
    //       See: https://github.com/flugger/laravel-responder
    //            https://fractal.thephpleague.com/

    private function transformCollections(array $collections): array
    {
        return array_map([$this, 'transformCollection'], $collections);
    }

    private function transformCollection(array $collection): array
    {
        // TODO: remove the collection key, as it's here just for backwards compatibility (it's now name)
        $collection['collection'] = $collection['name'];

        // TODO: remove as this is for backward compatibility only, unmanaged tables should now be return in
        //       a different endpoint
        $collection['managed'] = true;

        $collection['fields'] = $this->transformFields($collection['fields']);

        return $collection;
    }

    private function transformFields(array $fields): array
    {
        return array_map([$this, 'transformField'], $fields);
    }

    private function transformField(array $field): array
    {
        // TODO: remove the sort key, as it's here just for backwards compatibility (it's now index)

        $field['sort'] = $field['index'];
        unset($field['collection_id']);

        return $field;
    }
}
