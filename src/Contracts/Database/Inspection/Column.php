<?php

declare(strict_types=1);

namespace Directus\Contracts\Database\Inspection;

interface Column
{
    /**
     * Gets the column name.
     */
    public function name(): string;

    /**
     * Gets the column type.
     */
    public function type(): string;

    /**
     * Gets the column scale.
     */
    public function scale(): int;

    /**
     * Gets the column length.
     */
    public function length(): ?int;

    /**
     * Gets whether the column is a primary key or not.
     */
    public function primary(): bool;

    /**
     * Gets whether the column is unique or not.
     */
    public function unique(): bool;

    /**
     * Gets whether the type is unsigned or not.
     */
    public function unsigned(): bool;

    /**
     * Gets whether the column is nullable or not.
     */
    public function nullable(): bool;

    /**
     * Gets whether the column is fixed or not.
     */
    public function fixed(): bool;

    /**
     * Gets the column precision.
     */
    public function precision(): int;

    /**
     * Gets whether the column auto increments or not.
     */
    public function increments(): bool;

    /**
     * The default column value.
     *
     * @return mixed
     */
    public function default();
}
