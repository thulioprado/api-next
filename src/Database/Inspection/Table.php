<?php

declare(strict_types=1);

namespace Directus\Database\Inspection;

use Directus\Exceptions\ColumnNotFound;
use Directus\Exceptions\TableNotFound;
use Doctrine\DBAL\Schema\Column as DoctrineColumn;
use Doctrine\DBAL\Schema\Table as DoctrineTable;
use Illuminate\Support\Collection;
use Directus\Contracts\Database\Inspection\Table as TableContract;
use Directus\Contracts\Database\Inspection\Column as ColumnContract;

class Table implements TableContract
{
    /**
     * @var DoctrineTable
     */
    protected $table;

    /**
     * @var Collection
     */
    protected $columns = null;

    /**
     * @var Collection
     */
    protected $primaries;

    /**
     * @var Collection
     */
    protected $uniques;

    /**
     * Table constructor.
     * @param DoctrineTable $table
     */
    public function __construct(DoctrineTable $table)
    {
        $this->table = $table;

        $this->primaries = Collection::make();
        $this->uniques = Collection::make();

        // TODO: should support multi column primary keys and unique indexes later
        $indexes = $this->table->getIndexes();
        foreach ($indexes as $index) {
            if ($index->isPrimary()) {
                $this->primaries->push(
                    collect($index->getColumns())->sort()->all()
                );
            }

            if ($index->isUnique()) {
                $this->uniques->push(
                    collect($index->getColumns())->sort()->all()
                );
            }
        }
    }

    public function name(): string
    {
        return $this->table->getName();
    }

    /**
     * @param array<string> $columns
     */
    public function primary(string ...$columns): bool
    {
        $columns = collect($columns)->sort()->all();
        $index = $this->primaries->search($columns);
        return $index !== false;
    }

    /**
     * @param array<string> $columns
     */
    public function unique(string ...$columns): bool
    {
        $columns = collect($columns)->sort()->all();
        $index = $this->uniques->search($columns);
        return $index !== false;
    }

    /**
     * @return Collection<Column>
     */
    public function columns(): Collection
    {
        return $this->columns = $this->columns ?? collect(array_values($this->table->getColumns()))
            ->map(function (DoctrineColumn $column) {
                return new Column(
                    $column,
                    $this->primary($column->getName()),
                    $this->unique($column->getName())
                );
            });
    }

    /**
     * @throws ColumnNotFound
     */
    public function column(string $name): ColumnContract
    {
        $column = $this->columns()->filter(static function(Column $column) use ($name): bool {
            return $column->name() === $name;
        })->first();

        if ($column === null) {
            throw new ColumnNotFound($name);
        }

        return $column;
    }
}
