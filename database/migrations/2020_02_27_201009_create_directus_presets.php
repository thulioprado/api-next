<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusPresets extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('presets')->name(),
            static function (Blueprint $collection) use ($system) {
                $collection->uuid('id');
                $collection->uuid('user_id')->nullable();
                $collection->uuid('role_id')->nullable();
                $collection->uuid('collection_id')->nullable();
                $collection->string('title', 255)->nullable();
                $collection->string('search_query', 100)->nullable();
                $collection->json('filters')->nullable();
                $collection->string('view_type', 100)->default('tabular');
                $collection->text('view_query')->nullable();
                $collection->json('view_options')->nullable();
                $collection->json('translation')->nullable();
                $collection->unique(['user_id', 'collection_id', 'title']);

                $collection->foreign('user_id')->references('id')->on(
                    $system->collection('users')->name()
                );
                $collection->foreign('role_id')->references('id')->on(
                    $system->collection('roles')->name()
                );
                $collection->foreign('collection_id')->references('id')->on(
                    $system->collection('collections')->name()
                );
            }
        );

        $system->inspector()->table(
            $system->collection('presets')->name()
        )->comment('Directus presets.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('presets')->drop();
    }
}
