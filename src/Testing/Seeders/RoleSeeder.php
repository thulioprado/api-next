<?php

declare(strict_types=1);

namespace Directus\Testing\Seeders;

use Directus\Contracts\Database\Seeder;
use Directus\Database\Models\Role;

class RoleSeeder implements Seeder
{
    public function run(): void
    {
        $developer = new Role([
            'name' => 'Developer',
        ]);
        $developer->save();

        $user = new Role([
            'name' => 'User',
        ]);
        $user->save();
    }
}
