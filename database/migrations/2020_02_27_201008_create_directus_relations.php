<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRelations extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('relations')->name(),
            static function (Blueprint $collection) use ($system) {
                $collection->uuid('id')->primary();
                $collection->uuid('field_many_id');
                $collection->uuid('field_one_id');
                $collection->uuid('junction_field_id');

                $collection->foreign('field_many_id')->references('id')->on(
                    $system->collection('fields')->name()
                );

                $collection->foreign('field_one_id')->references('id')->on(
                    $system->collection('fields')->name()
                );

                $collection->foreign('junction_field_id')->references('id')->on(
                    $system->collection('fields')->name()
                );
            }
        );

        $system->inspector()->table(
            $system->collection('relations')->name()
        )->comment('Directus relations.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('relations')->drop();
    }
}
