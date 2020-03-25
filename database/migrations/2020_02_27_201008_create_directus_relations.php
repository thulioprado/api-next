<?php

declare(strict_types=1);

use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\System\Migration;
use Directus\Facades\Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRelations extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Directus::system()->schema()->create(
            Directus::system()->collection('relations')->name(),
            function (Blueprint $collection) {
                $collection->bigIncrements('id');
                $collection->uuid('collection_many_id');
                $collection->uuid('field_many_id');
                $collection->uuid('collection_one_id');
                $collection->uuid('field_one_id');
                $collection->uuid('junction_field_id');
            }
        );

        Directus::fields()->batch(function (FieldsService $fields): void {
            $fields->insert('0f8a5ea5-3e7b-400f-be63-664709fe11c9')
                ->on('relations')
                ->name('id')
                ->integer()
            ;
            $fields->insert('89d6b61d-b192-4c14-8be5-94de3fcfa150')
                ->on('relations')
                ->name('collection_many_id')
                ->string()
            ;
            $fields->insert('4a585602-83ff-4e5a-9d93-e7ec1b4e87bb')
                ->on('relations')
                ->name('field_many_id')
                ->string()
            ;
            $fields->insert('6dd896a3-7dc1-4b64-85c7-b38e29d43f57')
                ->on('relations')
                ->name('collection_one_id')
                ->string()
            ;
            $fields->insert('d93f3554-d7b3-47d4-be1e-8983ddeca68b')
                ->on('relations')
                ->name('field_one_id')
                ->string()
            ;
            $fields->insert('8cb866d0-8cc1-4cb8-af46-1be8109fbac7')
                ->on('relations')
                ->name('junction_field_id')
                ->string()
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Directus::system()->collection('relations')->drop();
    }
}
