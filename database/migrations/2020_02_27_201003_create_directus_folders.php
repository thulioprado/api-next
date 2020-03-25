<?php

declare(strict_types=1);

use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\System\Migration;
use Directus\Facades\Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusFolders extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Directus::system()->schema()->create(
            Directus::system()->collection('folders')->name(),
            function (Blueprint $collection) {
                // Identification
                $collection->uuid('id')->primary();
                $collection->uuid('parent_id')->nullable();
                $collection->string('name', 200);
                $collection->unique(['name', 'parent_id']);
            }
        );

        Directus::system()->schema()->table(
            Directus::system()->collection('folders')->name(),
            function (Blueprint $collection) {
                $collection->foreign('parent_id')->references('id')->on(
                    Directus::system()->collection('folders')->name()
                );
            }
        );

        Directus::system()->collections()->register(
            Directus::system()->collection('folders')->fullName(),
            '02fe3baa-3c82-4ae1-afdd-0638e3edb9c6'
        );

        // Create fields.
        Directus::fields()->batch(function (FieldsService $fields): void {
            $fields->insert('506850a7-59ce-43a4-b748-512d5a0d35d0')
                ->on('folders')
                ->name('id')
                ->integer()
                ->required()
                ->hidden_detail()
            ;
            $fields->insert('c064366d-efd1-4c5a-9d77-b2dbe036e810')
                ->on('folders')
                ->name('name')
                ->string()
            ;
            $fields->insert('b3ee98d6-18dd-45e0-891c-347117fa78c6')
                ->on('folders')
                ->name('parent_folder')
                ->m2o()
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Directus::system()->collection('folders')->drop();
    }
}
