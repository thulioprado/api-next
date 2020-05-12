<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRevisions extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('revisions')->name(),
            static function (Blueprint $collection) use ($system) {
                $collection->uuid('id')->primary();
                $collection->uuid('activity_id');
                $collection->uuid('collection_id');
                $collection->string('item', 255);
                $collection->longText('data');
                $collection->longText('delta')->nullable();
                $collection->uuid('parent_collection_id')->nullable();
                $collection->string('parent_item', 255)->nullable();
                $collection->boolean('parent_changed')->default(false);

                $collection->foreign('activity_id')->references('id')->on(
                    $system->collection('activities')->name()
                );
                $collection->foreign('collection_id')->references('id')->on(
                    $system->collection('collections')->name()
                );
            }
        );

        $system->inspector()->table(
            $system->collection('revisions')->name()
        )->comment('Directus revisions.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('revisions')->drop();
    }
}
