<?php

declare(strict_types=1);

namespace Directus\Testing\Seeders;

use Directus\Contracts\Database\Seeder;
use Directus\Database\Models\Role;
use Directus\Database\Models\User;

class UserSeeder implements Seeder
{
    public function run(): void
    {
        /** @var Role $devRole */
        $devRole = Role::where('name', 'Developer')->first();

        /** @var ROle $userRole */
        $userRole = Role::where('name', 'User')->first();

        /** @var User $developer */
        $developer = User::where('email', 'admin@example.com')->first();

        $developer->role()->associate($devRole);
        $developer->save();

        $user = new User([
            'status' => 'active',
            'first_name' => 'thulio',
            'last_name' => 'prado',
            'email' => 'thulioprado@gmail.com',
            'password' => 'directus',
            'role_id' => $userRole->id,
        ]);
        $user->save();
    }
}
