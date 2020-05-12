<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusFields extends Migration
{
    /**
     * Migration.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('fields')->name(),
            static function (Blueprint $collection) use ($system): void {
                $collection->uuid('id')->primary();
                $collection->uuid('collection_id');
                $collection->string('name', 128);
                $collection->string('type', 64);
                $collection->string('interface', 64);
                $collection->json('options')->nullable();
                $collection->boolean('locked')->default(false);
                $collection->string('validation', 500)->nullable();
                $collection->boolean('required')->default(false);
                $collection->boolean('readonly')->default(false);
                $collection->boolean('hidden_detail')->default(false);
                $collection->boolean('hidden_browse')->default(false);
                $collection->unsignedInteger('index')->nullable();
                $collection->string('width', 50)->nullable()->default('full');
                $collection->uuid('group_id')->nullable();
                $collection->string('note', 1024)->nullable();
                $collection->json('translation')->nullable();
                $collection->unique(['collection_id', 'name']);
                $collection->foreign('collection_id')->references('id')->on(
                    $system->collection('collections')->name()
                );
            }
        );

        $system->schema()->table(
            $system->collection('fields')->name(),
            static function (Blueprint $collection) use ($system): void {
                $collection->foreign('group_id')->references('id')->on(
                    $system->collection('fields')->name()
                );
            }
        );

        $system->inspector()->table(
            $system->collection('fields')->name()
        )->comment('Directus fields.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('fields')->drop();
    }
}
