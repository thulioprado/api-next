<?php

declare(strict_types=1);

namespace Directus\Testing;

use Directus\Contracts\Database\Seeder;
use Directus\Testing\Seeders\CollectionSeeder;
use Directus\Testing\Seeders\FileSeeder;
use Directus\Testing\Seeders\FolderSeeder;
use Directus\Testing\Seeders\PermissionSeeder;
use Directus\Testing\Seeders\RoleSeeder;
use Directus\Testing\Seeders\TableSeeder;
use Directus\Testing\Seeders\UserSeeder;

class DatabaseSeeder
{
    /**
     * @var string[]
     */
    public $seeders = [
        TableSeeder::class,
        CollectionSeeder::class,
        RoleSeeder::class,
        UserSeeder::class,
        PermissionSeeder::class,
        FolderSeeder::class,
        FileSeeder::class,
    ];

    /**
     * Executes testing database seeds.
     */
    public function run(): void
    {
        foreach ($this->seeders as $seederName) {
            /** @var Seeder $seeder */
            $seeder = new $seederName();
            $seeder->run();
        }
    }
}
