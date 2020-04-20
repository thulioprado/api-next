<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusCollectionPresets extends Migration
{
    use MigrateFields;
    use
        MigrateCollections;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = Directus::databases()->system();

        $system->schema()->create(
            $system->collection('collection_presets')->name(),
            function (Blueprint $collection) use ($system) {
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

        $this->registerCollection('ba159ee7-3e70-4a8b-853e-4904d785ab34', 'collection_presets');

        $this->registerField(
            $this->createField('1ec6efb5-eb28-4339-947c-f7becab46011')
                ->on('collection_presets')
                ->name('id')
                ->uuidType()
                ->required()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('8974c5ac-ca65-4e3d-8b68-bb435f11cf8c')
                ->on('collection_presets')
                ->name('user_id')
                ->integerType()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('9d145d82-674b-4fb8-a349-3c440aa8ccfa')
                ->on('collection_presets')
                ->name('role_id')
                ->m2oType()
                ->manyToOneInterface()
        );

        $this->registerField(
            $this->createField('8bcc2e36-efe5-4d83-a181-3f1a588404c0')
                ->on('collection_presets')
                ->name('collection_id')
                ->m2oType()
                ->manyToOneInterface()
        );

        $this->registerField(
            $this->createField('0750e423-9e8f-4b70-be95-ac6f8331624c')
                ->on('collection_presets')
                ->name('title')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('75352433-8998-4eff-8ed4-a1c72e47d7c8')
                ->on('collection_presets')
                ->name('search_query')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('b04b7ea7-849e-4c6f-a355-5f6193429517')
                ->on('collection_presets')
                ->name('filters')
                ->jsonType()
                ->jsonInterface()
        );

        $this->registerField(
            $this->createField('c73bbef4-6e10-4bd5-aa4e-17cbcd56180e')
                ->on('collection_presets')
                ->name('view_options')
                ->jsonType()
                ->jsonInterface()
        );

        $this->registerField(
            $this->createField('a5c6c662-d653-426e-8e82-389e6474a179')
                ->on('collection_presets')
                ->name('view_type')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('a1c4c28c-a941-492d-8b63-5544b5e2f4b0')
                ->on('collection_presets')
                ->name('view_query')
                ->jsonType()
                ->jsonInterface()
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('collection_presets');
        Directus::databases()->system()->collection('collection_presets')->drop();
    }
}
