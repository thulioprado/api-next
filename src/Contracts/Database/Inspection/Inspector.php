<?php

declare(strict_types=1);

namespace Directus\Contracts\Database\Inspection;

use Directus\Contracts\Database\Inspection\Column as ColumnContract;
use Directus\Contracts\Database\Inspection\Table as TableContract;
use Illuminate\Support\Collection;

interface Inspector
{
    /**
     * Gets a column.
     */
    public function column(string $table, string $column): ColumnContract;

    /*
     * Gets all columns.
     *
     * @return Collection<ColumnContract>
     */
    public function columns(): Collection;

    /**
     * Gets a table by name.
     */
    public function table(string $name): TableContract;

    /**
     * Gets all tables.
     *
     * @return Collection<TableContract>
     */
    public function tables(): Collection;
}
