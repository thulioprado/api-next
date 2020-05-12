<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusFiles extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('files')->name(),
            static function (Blueprint $collection) use ($system) {
                $collection->uuid('id')->primary();
                $collection->string('storage', 50)->default('local');
                $collection->string('private_hash', 16)->nullable();
                $collection->string('filename_disk', 255);
                $collection->string('filename_download', 255);
                $collection->string('title', 255)->nullable();
                $collection->string('type', 255)->nullable();
                $collection->uuid('uploaded_by_id');
                $collection->dateTime('uploaded_on'); // TODO: default current timestamp
                $collection->string('charset', 50)->nullable();
                $collection->integer('filesize')->unsigned()->default(0);
                $collection->integer('width')->unsigned()->nullable();
                $collection->integer('height')->unsigned()->nullable();
                $collection->integer('duration')->nullable();
                $collection->string('embed', 200)->nullable();
                $collection->uuid('folder_id')->nullable();
                $collection->text('description')->nullable();
                $collection->string('location', 200)->nullable();
                $collection->string('tags', 255)->nullable();
                $collection->string('checksum', 32)->nullable();
                $collection->text('metadata')->nullable();
                $collection->foreign('folder_id')->references('id')->on(
                    $system->collection('folders')->name()
                )->onDelete('set null');
                /*
                // TODO: This is a cross reference, how to deal with it?
                $collection->foreign('uploaded_by_id')->references('id')->on(
                    $system->collection('users')->name()
                );
                */
            }
        );

        $system->inspector()->table(
            $system->collection('files')->name()
        )->comment('Directus files.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('files')->drop();
    }
}
