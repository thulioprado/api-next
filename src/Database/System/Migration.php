<?php

declare(strict_types=1);

namespace Directus\Database\System;

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration as IlluminateMigration;
use stdClass;

/**
 * Directus migration.
 */
class Migration extends IlluminateMigration
{
    /**
     * Registers a new field.
     *
     * @param mixed $props
     */
    protected function registerField(string $id, string $collection_name, string $name, string $type, string $interface, $props = []): void
    {
        $collection_name = Directus::system()->collection($collection_name)->name();

        /** @var stdClass $collection */
        $collection = Directus::system()->collection('collections')->query()->where('name', '=', $collection_name)->first();

        $field = collect([
            'id' => $id,
            'collection_id' => $collection->id,
            'name' => $name,
            'type' => $type,
            'interface' => $interface,
        ]);

        if (isset($props['options']) && \is_array($props['options'])) {
            $props['options'] = json_encode($props['options'], JSON_THROW_ON_ERROR, 512);
        }

        if ($interface === 'primary-key' && !isset($props['required'])) {
            $props['required'] = true;
        }

        if (!isset($props['locked'])) {
            $props['locked'] = true;
        }

        if (!isset($props['index'])) {
            $props['index'] = Directus::system()->collection('fields')->query()->where('collection_id', '=', $collection->id)->count() + 1;
        }

        if (!isset($props['width'])) {
            $props['width'] = 'full';
        }

        $defaults = [
            'options' => null,
            'validation' => null,
            'required' => false,
            'readonly' => false,
            'hidden_detail' => false,
            'hidden_browse' => false,
            'width' => 'full',
            'group' => null,
            'note' => null,
            'translation' => null,
        ];

        foreach ($defaults as $field_default_key => $field_default_value) {
            if (!isset($props[$field_default_key])) {
                $props[$field_default_key] = $field_default_value;
            }
        }

        Directus::system()->collection('fields')->query()->insert($field->merge($props)->toArray());
    }
}
