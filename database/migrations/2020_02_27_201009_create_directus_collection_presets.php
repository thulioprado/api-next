<?php

declare(strict_types=1);

use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\System\Migration;
use Directus\Facades\Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusCollectionPresets extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Directus::system()->schema()->create(
            Directus::system()->collection('collection_presets')->name(),
            function (Blueprint $collection) {
                $collection->uuid('id');
                $collection->uuid('user_id')->nullable();
                $collection->uuid('role_id')->nullable();
                $collection->uuid('collection_id')->nullable();
                $collection->string('title', 255)->nullable();
                $collection->string('search_query', 100)->nullable();
                $collection->text('filters')->nullable();
                $collection->string('view_type', 100)->default('tabular');
                $collection->text('view_query')->nullable();
                $collection->text('view_options')->nullable();
                $collection->text('translation')->nullable();
                $collection->unique(['user_id', 'collection_id', 'title']);

                $collection->foreign('user_id')->references('id')->on(
                    Directus::system()->collection('users')->name()
                );
                $collection->foreign('role_id')->references('id')->on(
                    Directus::system()->collection('roles')->name()
                );
                $collection->foreign('collection_id')->references('id')->on(
                    Directus::system()->collection('collections')->name()
                );
            }
        );

        Directus::fields()->batch(function (FieldsService $fields): void {
            $fields->insert('1ec6efb5-eb28-4339-947c-f7becab46011')
                ->on('collection_presets')
                ->name('id')
                ->integer()
            ;
            $fields->insert('8974c5ac-ca65-4e3d-8b68-bb435f11cf8c')
                ->on('collection_presets')
                ->name('user_id')
                ->integer()
            ;
            $fields->insert('9d145d82-674b-4fb8-a349-3c440aa8ccfa')
                ->on('collection_presets')
                ->name('role_id')
                ->m2o()
            ;
            $fields->insert('8bcc2e36-efe5-4d83-a181-3f1a588404c0')
                ->on('collection_presets')
                ->name('collection_id')
                ->m2o()
            ;
            $fields->insert('0750e423-9e8f-4b70-be95-ac6f8331624c')
                ->on('collection_presets')
                ->name('title')
                ->string()
            ;
            $fields->insert('75352433-8998-4eff-8ed4-a1c72e47d7c8')
                ->on('collection_presets')
                ->name('search_query')
                ->string()
            ;
            $fields->insert('b04b7ea7-849e-4c6f-a355-5f6193429517')
                ->on('collection_presets')
                ->name('filters')
                ->json()
            ;
            $fields->insert('c73bbef4-6e10-4bd5-aa4e-17cbcd56180e')
                ->on('collection_presets')
                ->name('view_options')
                ->json()
            ;
            $fields->insert('a5c6c662-d653-426e-8e82-389e6474a179')
                ->on('collection_presets')
                ->name('view_type')
                ->string()
            ;
            $fields->insert('a1c4c28c-a941-492d-8b63-5544b5e2f4b0')
                ->on('collection_presets')
                ->name('view_query')
                ->json()
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Directus::system()->collection('collection_presets')->drop();
    }
}
