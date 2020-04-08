<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusFolders extends Migration
{
    use MigrateCollections;
    use
        MigrateFields;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = Directus::databases()->system();

        $system->schema()->create(
            $system->collection('folders')->name(),
            function (Blueprint $collection) {
                $collection->uuid('id')->primary();
                $collection->uuid('parent_id')->nullable();
                $collection->string('name', 200);
                $collection->unique(['name', 'parent_id']);
            }
        );

        $system->schema()->table(
            $system->collection('folders')->name(),
            function (Blueprint $collection) use ($system) {
                $collection->foreign('parent_id')->references('id')->on(
                    $system->collection('folders')->name()
                );
            }
        );

        $this->registerCollection('02fe3baa-3c82-4ae1-afdd-0638e3edb9c6', 'folders');

        $this->registerField(
            $this->createField('506850a7-59ce-43a4-b748-512d5a0d35d0')
                ->on('folders')
                ->name('id')
                ->uuid()
                ->required()
                ->textInputInterface([
                    'monospace' => true,
                ])
                ->hidden_detail()
        );

        $this->registerField(
            $this->createField('c064366d-efd1-4c5a-9d77-b2dbe036e810')
                ->on('folders')
                ->name('name')
                ->string()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('b3ee98d6-18dd-45e0-891c-347117fa78c6')
                ->on('folders')
                ->name('parent_folder')
                ->m2o()
                ->manyToOneInterface()
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('folders');
        Directus::databases()->system()->collection('folders')->drop();
    }
}
