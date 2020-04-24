<?php

declare(strict_types=1);

namespace Directus\Database\Inspection;

use Directus\Contracts\Database\Inspection\Table as TableContract;
use Directus\Contracts\Database\Inspection\Column as ColumnContract;
use Directus\Contracts\Database\Inspection\Inspector as InspectorContract;
use Directus\Contracts\Database\Database as DatabaseContract;
use Directus\Exceptions\TableNotFound;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\Table as DoctrineTable;
use Illuminate\Support\Collection;

class Inspector implements InspectorContract
{
    /**
     * @var DatabaseContract
     */
    protected $database;

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var AbstractSchemaManager
     */
    protected $schema;

    /**
     * Inspector constructor.
     * @param DatabaseContract $database
     */
    public function __construct(DatabaseContract $database)
    {
        $this->database = $database;

        /** @var \Illuminate\Database\Connection $connection */
        $connection = $database->connection();

        $this->connection = $connection->getDoctrineConnection();
        $this->schema = $connection->getDoctrineSchemaManager();
    }

    /**
     * @throws TableNotFound
     */
    public function column(string $tableName, string $columnName): ColumnContract
    {
        return $this->table($tableName)->column($columnName);
    }

    public function columns(string $tableName = null): Collection
    {
        $columns = Collection::make();

        $tables = $this->tables()->filter(static function (Table $table) use ($tableName) {
            return $tableName === null || $table->name() === $tableName;
        });

        foreach ($tables as $table) {
            /** @var TableContract $table */
            $columns->merge($table->columns());
        }

        return $columns;
    }

    /**
     * @throws TableNotFound
     */
    public function table(string $tableName): TableContract
    {
        $tables = $this->tables();

        $table = $tables->search(static function (Table $table) use ($tableName): bool {
            return $table->name() === $tableName;
        });

        if ($table === null || $table === false) {
            throw new TableNotFound($tableName);
        }

        return $tables[$table];
    }

    /**
     * @return Collection<TableContract>
     */
    public function tables(): Collection
    {
        $tables = $this->schema->listTables();
        return collect($tables)->map(static function (DoctrineTable $table): Table {
            return new Table($table);
        });
    }
}
