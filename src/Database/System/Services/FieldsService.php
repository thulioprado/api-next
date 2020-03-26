<?php

declare(strict_types=1);

namespace Directus\Database\System\Services;

use Directus\Contracts\Database\System\Services\FieldsService as FieldsServiceContract;
use Directus\Database\System\Models\Field;
use Illuminate\Support\Traits\Macroable;

class FieldsService extends Service implements FieldsServiceContract
{
    use Macroable;

    /**
     * @var array<FieldDefinition>
     */
    protected $changes = [];

    /**
     * Returns whether blueprint has defined fields.
     */
    public function modified(): bool
    {
        return \count($this->changes) > 0;
    }

    /**
     * Inserts a new field.
     */
    public function insert(string $id, ?int $index = null): FieldDefinition
    {
        return $this->register('insert', $id, $index);
    }

    /**
     * Updates an existing field.
     */
    public function update(string $id): FieldDefinition
    {
        return $this->register('update', $id);
    }

    /**
     * Inserts a new field.
     */
    public function delete(string $id): void
    {
        $this->register('delete', $id);
    }

    /**
     * Applies changes to the database.
     */
    public function save(): void
    {
        if ($this->modified()) {
            return;
        }

        foreach ($this->changes as $field) {
            $this->applyFieldChanges($field);
        }

        $this->changes = [];
    }

    /**
     * Discard all registered changes.
     */
    public function discard(): void
    {
        $this->changes = [];
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Throwable
     */
    public function batch(\Closure $callback): void
    {
        try {
            $this->system()->connection()->transaction(function () use ($callback): void {
                $callback($this);
                $this->save();
            });
        } catch (\Throwable $err) {
            $this->discard();

            throw $err;
        }
    }

    /**
     * Applies a field action into the database.
     */
    protected function applyFieldChanges(FieldDefinition $field): void
    {
        $this->fillFieldCollection($field);
        $this->checkForRequiredFieldProperties($field);
        $this->normalizeFieldValues($field);
        $this->executeFieldAction($field);
    }

    /**
     * Fills the field collection id if needed.
     */
    protected function fillFieldCollection(FieldDefinition $field): void
    {
        if (isset($field->on)) {
            $field->collection_id(
                (string) $this->system()->collections()->getByName($field->on)->id
            );
            unset($field['on']);
        }

        if (isset($field->collection)) {
            $field->collection_id(
                (string) $this->system()->collections()->getByName($field->collection)->id
            );
            unset($field['collection']);
        }
    }

    /**
     * Checks wether the field has all the required fields.
     */
    protected function checkForRequiredFieldProperties(FieldDefinition $field): void
    {
        foreach (['id', 'name', 'type', 'interface', 'collection_id'] as $required) {
            if (!isset($field[$required])) {
                throw new \RuntimeException("Missing field: {$required}");
            }
        }
    }

    /**
     * Normalize field values based on its contents.
     */
    protected function normalizeFieldValues(FieldDefinition $field): void
    {
        if (isset($field->options) && \is_array($field->options)) {
            $field->options(json_encode($field->options, JSON_THROW_ON_ERROR, 512));
        }

        if (isset($field->interface) && $field->interface === 'primary-key' && !isset($field->required)) {
            $field->required();
        }

        if (!isset($field->index)) {
            $field->index(
                $this->system()->collection('fields')->query()
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
            'group' => null,
            'note' => null,
            'translation' => null,
        ];

        foreach ($defaults as $field_default_key => $field_default_value) {
            if (!isset($field[$field_default_key])) {
                $field->set($field_default_key, $field_default_value);
            }
        }
    }

    /**
     * Executes a field action on the database.
     */
    protected function executeFieldAction(FieldDefinition $field): void
    {
        $action = $field['action'];
        unset($field['action']);

        switch ($action) {
            case 'insert':
                $entry = new Field($field->toArray());
                $entry->save();

                break;
            case 'update':
                Field::where('id', $field['id'])->update($field->toArray());

                break;
            case 'delete':
                $entry = Field::where('id', $field['id'])->first();
                if ($entry === null) {
                    throw new \RuntimeException("Failed to delete unknown field ${field['id']}");
                }
                $entry->delete();

                break;
            default:
                throw new \RuntimeException("Unknown blueprint action {$action}");
        }
    }

    /**
     * Defines a field.
     */
    private function register(string $action, string $id, ?int $index = null): FieldDefinition
    {
        $field = new FieldDefinition($id);
        $field->action($action);
        if ($index !== null) {
            $field->index($index);
        }
        $this->changes[] = $field;

        return $field;
    }
}
