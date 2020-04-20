<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRelations extends Migration
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
            $system->collection('relations')->name(),
            function (Blueprint $collection) {
                $collection->uuid('id')->primary();
                $collection->uuid('collection_many_id');
                $collection->uuid('field_many_id');
                $collection->uuid('collection_one_id');
                $collection->uuid('field_one_id');
                $collection->uuid('junction_field_id');
            }
        );

        $this->registerCollection('7667a018-6bc8-42ac-853f-8cafdf197b7a', 'relations');

        $this->registerField(
            $this->createField('0f8a5ea5-3e7b-400f-be63-664709fe11c9')
                ->on('relations')
                ->name('id')
                ->uuidType()
                ->required()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );
        $this->registerField(
            $this->createField('89d6b61d-b192-4c14-8be5-94de3fcfa150')
                ->on('relations')
                ->name('collection_many_id')
                ->stringType()
                ->collectionsInterface()
        );
        $this->registerField(
            $this->createField('4a585602-83ff-4e5a-9d93-e7ec1b4e87bb')
                ->on('relations')
                ->name('field_many_id')
                ->stringType()
                ->fieldsInterface()
        );
        $this->registerField(
            $this->createField('6dd896a3-7dc1-4b64-85c7-b38e29d43f57')
                ->on('relations')
                ->name('collection_one_id')
                ->stringType()
                ->collectionsInterface()
        );
        $this->registerField(
            $this->createField('d93f3554-d7b3-47d4-be1e-8983ddeca68b')
                ->on('relations')
                ->name('field_one_id')
                ->stringType()
                ->fieldsInterface()
        );
        $this->registerField(
            $this->createField('8cb866d0-8cc1-4cb8-af46-1be8109fbac7')
                ->on('relations')
                ->name('junction_field_id')
                ->stringType()
                ->fieldsInterface()
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('relations');
        Directus::databases()->system()->collection('relations')->drop();
    }
}
