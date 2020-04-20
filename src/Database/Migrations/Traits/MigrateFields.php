<?php

declare(strict_types=1);

namespace Directus\Database\Migrations\Traits;

use Directus\Facades\Directus;
use Directus\Services\Fields\Definition;

trait MigrateFields
{
    protected function createField(string $id): Definition
    {
        return new Definition($id);
    }

    protected function unregisterFieldsFrom(string $name): void
    {
        $system = Directus::databases()->system();
        $collections = $system->collection('collections');
        $fields = $system->collection('fields');

        $collection = $collections->builder()->where('name', '=', $system->collection($name)->fullName())->first();
        if ($collection !== null) {
            $fields->builder()->where('collection_id', '=', $collection->id)->delete();
        }
    }

    protected function registerField(Definition $field): void
    {
        $system = Directus::databases()->system();
        $collections = $system->collection('collections');
        $fields = $system->collection('fields');

        $target_collection = '';

        if (isset($field->on)) {
            $target_collection = $field->on;
            unset($field['on']);
        }

        if (isset($field->collection)) {
            $target_collection = $field->collection;
            unset($field['collection']);
        }

        if ($target_collection !== '') {
            $field->collection_id(
                $collections->builder()
                    ->where('name', '=', $system->collection($target_collection)->fullName())
                    ->first()
                    ->id
            );
        }

        if (isset($field->options) && \is_array($field->options)) {
            $field->options(json_encode($field->options, JSON_THROW_ON_ERROR, 512));
        }

        if (isset($field->interface) && $field->interface === 'primary-key' && !isset($field->required)) {
            $field->required();
        }

        if (!isset($field->index)) {
            $field->index(
                $fields->builder()
                    ->where('collection_id', '=', $field['collection_id'])
                    ->count() + 1
            );
        }

        if (!isset($field->width)) {
            $field->width('full');
        }

        $defaults = [
            'options' => null,
            'validation' => null,
            'required' => false,
            'readonly' => false,
            'hidden_detail' => false,
            'hidden_browse' => false,
            'width' => 'full',
            'group_id' => null,
            'note' => null,
            'translation' => null,
        ];

        foreach ($defaults as $field_default_key => $field_default_value) {
            if (!isset($field[$field_default_key])) {
                $field->set($field_default_key, $field_default_value);
            }
        }

        $fields->builder()->insert($field->toArray());
    }
}
