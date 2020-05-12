<?php

declare(strict_types=1);

namespace Directus\Testing\Seeders;

use Carbon\Carbon;
use Directus\Contracts\Database\Seeder;
use Directus\Database\Models\File;
use Directus\Database\Models\Folder;
use Directus\Database\Models\User;

class FileSeeder implements Seeder
{
    public function run(): void
    {
        /** @var Folder $folder */
        $folder = Folder::where('name', 'Baby Folder')->first();

        /** @var User $user */
        $user = User::where('email', 'admin@example.com')->first();

        $file = new File([
            'storage' => 'public',
            'filename_disk' => '',
            'filename_download' => '',
            'uploaded_by_id' => $user->id,
            'uploaded_on' => Carbon::now(),
            'folder_id' => $folder->id,
        ]);
        $file->save();

        $file = new File([
            'storage' => 'private',
            'filename_disk' => '',
            'filename_download' => '',
            'uploaded_by_id' => $user->id,
            'uploaded_on' => Carbon::now(),
            'folder_id' => $folder->id,
        ]);
        $file->save();

        $file = new File([
            'storage' => 'protected',
            'filename_disk' => '',
            'filename_download' => '',
            'uploaded_by_id' => $user->id,
            'uploaded_on' => Carbon::now(),
            'folder_id' => $folder->id,
        ]);
        $file->save();
    }
}
