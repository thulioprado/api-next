<?php

declare(strict_types=1);

namespace Directus\Contracts\Database;

/**
 * Seeder contract.
 */
interface Seeder
{
    public function run(): void;
}
