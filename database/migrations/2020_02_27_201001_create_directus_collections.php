<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusCollections extends Migration
{
    /**
     * Migration.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('collections')->name(),
            static function (Blueprint $collection): void {
                $collection->uuid('id')->primary();
                $collection->string('name', 128)->unique();
                $collection->boolean('hidden')->default(false);
                $collection->boolean('single')->default(false);
                $collection->boolean('system')->default(false);
                $collection->string('icon', 30)->nullable();
                $collection->string('note', 255)->nullable();
                $collection->json('translation')->nullable();
            }
        );

        $system->inspector()->table(
            $system->collection('collections')->name()
        )->comment('Directus collections.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('collections')->drop();
    }
}
