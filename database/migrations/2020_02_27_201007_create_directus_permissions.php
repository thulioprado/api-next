<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusPermissions extends Migration
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
            $system->collection('permissions')->name(),
            function (Blueprint $collection) use ($system) {
                // Identification
                $collection->uuid('id')->primary();
                $collection->uuid('collection_id');
                $collection->uuid('role_id');

                // Settings
                $collection->string('create', 16)->default('none');
                $collection->string('read', 16)->default('none');
                $collection->string('update', 16)->default('none');
                $collection->string('delete', 16)->default('none');
                $collection->string('comment', 8)->default('none');
                $collection->string('explain', 8)->default('none');

                // Control
                $collection->string('status', 64)->nullable();
                $collection->string('status_blacklist', 1000)->nullable();
                $collection->string('read_field_blacklist', 1000)->nullable();
                $collection->string('write_field_blacklist', 1000)->nullable();

                $collection->foreign('collection_id')->references('id')->on(
                    $system->collection('collections')->name()
                );

                $collection->foreign('role_id')->references('id')->on(
                    $system->collection('roles')->name()
                );
            },
        );

        $this->registerCollection('02261985-0a59-4fff-8101-b6b09a72ac99', 'permissions');

        $this->registerField(
            $this->createField('2195a3ee-169a-4789-933c-3da8b2236373')
                ->on('permissions')
                ->name('id')
                ->uuidType()
                ->required()
                ->hidden_detail()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('dacc517e-4295-47e4-ba63-9bc0baaa809f')
                ->on('permissions')
                ->name('collection_id')
                ->m2oType()
                ->manyToOneInterface()
        );

        $this->registerField(
            $this->createField('573ad421-4868-4799-af0b-78205054cb39')
                ->on('permissions')
                ->name('role_id')
                ->m2oType()
                ->manyToOneInterface()
        );

        $this->registerField(
            $this->createField('23b8f393-8c36-467e-81b6-00f7ed5656c0')
                ->on('permissions')
                ->name('status')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('ee5f6a76-14e4-470e-86ba-621a5953e789')
                ->on('permissions')
                ->name('create')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('57bc5bb4-81cd-4a54-8511-de057daa1c29')
                ->on('permissions')
                ->name('read')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('8510ac8a-0a19-4f4f-ac4a-b81832d23023')
                ->on('permissions')
                ->name('update')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('c083c02c-330c-47d9-84a5-d295aa59a57c')
                ->on('permissions')
                ->name('delete')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('30ea7caa-394d-4bb4-a741-9ce4bd9fa901')
                ->on('permissions')
                ->name('comment')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('36004f1e-e302-4c8f-87d6-bf5266c5e019')
                ->on('permissions')
                ->name('explain')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('2e9b0688-4993-4052-9382-f1587b00081e')
                ->on('permissions')
                ->name('status_blacklist')
                ->arrayType()
                ->tagsInterface()
        );

        $this->registerField(
            $this->createField('21b2cbb9-d056-4445-8a63-e03c4106ec2d')
                ->on('permissions')
                ->name('read_field_blacklist')
                ->arrayType()
                ->tagsInterface()
        );

        $this->registerField(
            $this->createField('b901a97e-4ab6-4c94-b0e2-af2aa772a48d')
                ->on('permissions')
                ->name('write_field_blacklist')
                ->arrayType()
                ->tagsInterface()
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('permissions');
        Directus::databases()->system()->collection('permissions')->drop();
    }
}
