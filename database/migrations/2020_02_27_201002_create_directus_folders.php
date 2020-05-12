<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusFolders extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('folders')->name(),
            static function (Blueprint $collection) use ($system) {
                $collection->uuid('id')->primary();
                $collection->uuid('parent_id')->nullable();
                $collection->string('name', 200);
                $collection->unique(['name', 'parent_id']);
                $collection->foreign('parent_id')->references('id')->on(
                    $system->collection('folders')->name()
                )->onDelete('cascade');
            }
        );

        /*
        $system->schema()->table(
            $system->collection('folders')->name(),
            static function (Blueprint $collection) use ($system) {
                $collection->foreign('parent_id')->references('id')->on(
                    $system->collection('folders')->name()
                );
            }
        );
        */

        $system->inspector()->table(
            $system->collection('folders')->name()
        )->comment('Directus folders.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('folders')->drop();
    }
}
