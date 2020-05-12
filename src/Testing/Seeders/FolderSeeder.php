<?php

declare(strict_types=1);

namespace Directus\Testing\Seeders;

use Directus\Contracts\Database\Seeder;
use Directus\Database\Models\Folder;

class FolderSeeder implements Seeder
{
    public function run(): void
    {
        $parent = new Folder([
            'name' => 'Main Folder',
        ]);
        $parent->save();

        $child = new Folder([
            'name' => 'Child Folder',
            'parent_id' => $parent->id,
        ]);
        $child->save();

        $baby = new Folder([
            'name' => 'Baby Folder',
            'parent_id' => $child->id,
        ]);
        $baby->save();
    }
}
