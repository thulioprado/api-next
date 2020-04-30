<?php

declare(strict_types=1);

namespace Directus\Services\Fields;

use Directus\Contracts\Database\Collection;
use Directus\Contracts\Database\Database;
use Directus\Contracts\Services\Service;
use Directus\Database\Models\Field;
use Directus\Services\Collections\CollectionsService;
use Directus\Services\Databases\DatabasesService;
use JsonException;
use Throwable;

class FieldsService implements Service
{
    /**
     * @var array
     */
    protected $changes = [];

    /**
     * @var DatabasesService
     */
    protected $databases;

    /**
     * @var CollectionsService
     */
    protected $collections;

    /**
     * @var Database
     */
    protected $system;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * FieldsService constructor.
     */
    public function __construct(DatabasesService $databases, CollectionsService $collections)
    {
        $this->databases = $databases;
        $this->collections = $collections;
        $this->system = $this->databases->system();
        $this->collection = $databases->system()->collection('fields');
    }

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
    public function insert(string $id, ?int $index = null): Definition
    {
        return $this->register('insert', $id, $index);
    }

    /**
     * Updates an existing field.
     */
    public function update(string $id): Definition
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
     *
     * @throws JsonException
     */
    public function save(): void
    {
        if (!$this->modified()) {
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
     * @throws Throwable
     */
    public function batch(\Closure $callback): void
    {
        try {
            $this->system->connection()->transaction(function () use ($callback): void {
                $callback($this);
                $this->save();
            });
        } catch (Throwable $err) {
            $this->discard();

            throw $err;
        }
    }

    /**
     * Applies a field action into the database.
     *
     * @throws JsonException
     */
    protected function applyFieldChanges(Definition $field): void
    {
        $this->fillFieldCollection($field);
        $this->checkForRequiredFieldProperties($field);
        $this->normalizeFieldValues($field);
        $this->executeFieldAction($field);
    }

    /**
     * Fills the field collection id if needed.
     */
    protected function fillFieldCollection(Definition $field): void
    {
        if (isset($field->on)) {
            $field->collection_id(
                (string) $this->collections->find($field->on)['id']
            );
            unset($field['on']);
        }

        if (isset($field->collection)) {
            $field->collection_id(
                (string) $this->collections->find($field->collection)['id']
            );
            unset($field['collection']);
        }
    }

    /**
     * Checks wether the field has all the required fields.
     */
    protected function checkForRequiredFieldProperties(Definition $field): void
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
    protected function normalizeFieldValues(Definition $field): void
    {
        if (isset($field->options) && \is_array($field->options)) {
            $field->options(json_encode($field->options, JSON_THROW_ON_ERROR, 512));
        }

        if (isset($field->interface) && $field->interface === 'primary-key' && !isset($field->required)) {
            $field->required();
        }

        if (!isset($field->index)) {
            $field->index(
                $this->collection->builder()
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
    }

    /**
     * Executes a field action on the database.
     */
    protected function executeFieldAction(Definition $field): void
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
    private function register(string $action, string $id, ?int $index = null): Definition
    {
        $field = new Definition($id);
        $field->action($action);
        if ($index !== null) {
            $field->index($index);
        }
        $this->changes[] = $field;

        return $field;
    }
}
