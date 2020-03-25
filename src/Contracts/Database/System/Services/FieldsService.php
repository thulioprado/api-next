<?php

declare(strict_types=1);

namespace Directus\Contracts\Database\System\Services;

use Directus\Database\System\Services\FieldDefinition;

/**
 * Fields interface.
 */
interface FieldsService
{
    /**
     * Inserts a new field.
     */
    public function insert(string $id, ?int $index = null): FieldDefinition;

    /**
     * Updates an existing field.
     */
    public function update(string $id): FieldDefinition;

    /**
     * Inserts a new field.
     */
    public function delete(string $id): void;

    /**
     * Executes a batch operation.
     */
    public function batch(\Closure $callback): void;

    /**
     * Returns whether blueprint has defined fields.
     */
    public function modified(): bool;

    /**
     * Apply changes to fields.
     */
    public function save(): void;
}
