<?php

declare(strict_types=1);

namespace Directus\Contracts\Database\Inspection;

use Directus\Contracts\Database\Inspection\Column as ColumnContract;
use Illuminate\Support\Collection;

interface Table
{
    /**
     * Gets the table name.
     */
    public function name(): string;

    /**
     * Gets or sets the table comment.
     */
    public function comment(?string $new = null): string;

    /**
     * Gets a column by name.
     *
     * @return Column
     */
    public function column(string $name): ColumnContract;

    /**
     * Gets all columns.
     *
     * @return Collection<ColumnContract>
     */
    public function columns(): Collection;
}
