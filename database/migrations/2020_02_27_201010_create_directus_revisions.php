<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRevisions extends Migration
{
    use MigrateCollections,
        MigrateFields;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = Directus::databases()->system();

        $system->schema()->create(
            $system->collection('revisions')->name(),
            function (Blueprint $collection) use ($system) {
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

        $this->registerCollection('2d9449e7-55be-4240-b17f-be598b0faac1', 'revisions');

        $this->registerField(
            $this->createField('e5caa751-7a79-4e22-a207-3c42a3add63d')
                ->on('revisions')
                ->name('id')
                ->uuidType()
                ->required()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('3099eac4-91eb-4064-b574-af3927047365')
                ->on('revisions')
                ->name('activity')
                ->m2oType()
                ->manyToOneInterface()
        );

        $this->registerField(
            $this->createField('9f6c2786-02a5-4fff-8af0-0c52972c58c5')
                ->on('revisions')
                ->name('collection')
                ->m2oType()
                ->manyToOneInterface()
        );

        $this->registerField(
            $this->createField('d15a7011-cbd4-48c8-92d4-81f7d72224dc')
                ->on('revisions')
                ->name('item')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('215ce72b-54cd-439d-9cfe-e2788aad82a8')
                ->on('revisions')
                ->name('data')
                ->jsonType()
                ->jsonInterface()
        );

        $this->registerField(
            $this->createField('beca1b78-2275-4151-b1c1-9f1900e59d6e')
                ->on('revisions')
                ->name('delta')
                ->jsonType()
                ->jsonInterface()
        );

        $this->registerField(
            $this->createField('1e1d184f-e38c-4786-97b5-e4ffd914a329')
                ->on('revisions')
                ->name('parent_item')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('0cbee19f-b82b-4429-8efe-2362949fb657')
                ->on('revisions')
                ->name('parent_collection')
                ->stringType()
                ->collectionsInterface()
        );

        $this->registerField(
            $this->createField('6ccbc80d-ec03-44bb-84dc-2b4d2c054943')
                ->on('revisions')
                ->name('parent_changed')
                ->booleanType()
                ->switchInterface()
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('revisions');
        Directus::databases()->system()->collection('revisions')->drop();
    }
}
