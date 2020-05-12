<?php

declare(strict_types=1);

namespace Directus\Testing\Seeders;

use Directus\Contracts\Database\Seeder;
use Directus\Database\Models\Collection;

class CollectionSeeder implements Seeder
{
    public function run(): void
    {
        $authors = new Collection([
            'name' => 'authors',
        ]);
        $authors->save();

        $posts = new Collection([
            'name' => 'posts',
        ]);
        $posts->save();
    }
}
