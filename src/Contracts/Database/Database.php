<?php

declare(strict_types=1);

namespace Directus\Contracts\Database;

use Directus\Contracts\Database\Inspection\Inspector as InspectorContract;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Schema\Builder;

interface Database
{
    /**
     * Gets the database collection prefix.
     */
    public function prefix(): string;

    /**
     * Gets the connection driver.
     */
    public function driver(): string;

    /**
     * Gets the connection name.
     */
    public function connectionName(): string;

    /**
     * Gets the connection.
     */
    public function connection(): ConnectionInterface;

    /**
     * Gets the schema builder.
     */
    public function schema(): Builder;

    /**
     * Gets the database inspector.
     */
    public function inspector(): InspectorContract;

    /**
     * Gets a collection.
     */
    public function collection(string $name, ?string $class = null): Collection;
}
