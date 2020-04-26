<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusCollectionsAndFields extends Migration
{
    use MigrateCollections,
        MigrateFields;

    /**
     * Migration.
     */
    public function up(): void
    {
        $system = Directus::databases()->system();

        $system->schema()->create(
            $system->collection('collections')->name(),
            function (Blueprint $collection): void {
                $collection->uuid('id')->primary();
                $collection->string('name', 128)->unique();
                $collection->boolean('hidden')->default(false);
                $collection->boolean('single')->default(false);
                $collection->boolean('system')->default(false);
                $collection->string('icon', 30)->nullable();
                $collection->string('note', 255)->nullable();
                $collection->json('translation')->nullable();
            }
        );

        $this->registerCollection('b0b202dd-3cdc-480d-8deb-1db2c543f973', 'collections');

        $system->schema()->create(
            $system->collection('fields')->name(),
            function (Blueprint $collection) use ($system): void {
                $collection->uuid('id')->primary();
                $collection->uuid('collection_id');
                $collection->string('name', 128);
                $collection->string('type', 64);
                $collection->string('interface', 64);
                $collection->json('options')->nullable();
                $collection->boolean('locked')->default(false);
                $collection->string('validation', 500)->nullable();
                $collection->boolean('required')->default(false);
                $collection->boolean('readonly')->default(false);
                $collection->boolean('hidden_detail')->default(false);
                $collection->boolean('hidden_browse')->default(false);
                $collection->unsignedInteger('index')->nullable();
                $collection->string('width', 50)->nullable()->default('full');
                $collection->uuid('group_id')->nullable();
                $collection->string('note', 1024)->nullable();
                $collection->json('translation')->nullable();
                $collection->unique(['collection_id', 'name']);
                $collection->foreign('collection_id')->references('id')->on(
                    $system->collection('collections')->name()
                );
            }
        );

        $system->schema()->table(
            $system->collection('fields')->name(),
            function (Blueprint $collection) use ($system): void {
                $collection->foreign('group_id')->references('id')->on(
                    $system->collection('fields')->name()
                );
            }
        );

        $this->registerCollection('b03b7c91-3aa9-473c-b677-e8ab6f19b7d3', 'fields');

        $this->registerField(
            $this->createField('f6ce0656-2237-4128-8ab8-5c8c0ee74d71')->on('collections')
                ->name('fields')
                ->o2mType()
                ->oneToManyInterface()
                ->hidden_browse()
                ->hidden_detail()
        );

        $this->registerField(
            $this->createField('a05e6938-be1e-4d34-8c94-a6c7649a9f05')
                ->on('collections')
                ->name('name')
                ->uuidType()
                ->required()
                ->textInputInterface([
                    'monospace' => true,
                ])
                ->readonly()
                ->width('half')
        );

        $this->registerField(
            $this->createField('d09911f2-8d0e-44df-8d17-8a4268925adb')
                ->on('collections')
                ->name('note')
                ->stringType()
                ->textInputInterface()
                ->width('half')
                ->note('An internal description.')
        );

        /*
        $this->registerField(
            $this->createField('c4a9e06a-29ce-49aa-9b09-d31354a460d2')
                ->on('collections')
                ->name('managed')
                ->booleanType()
                ->switchInterface()
                ->width('half')
                ->hidden_detail()
                ->note('[Learn More](https://docs.directus.io/guides/collections.html#managing-collections).')
        );
        */

        $this->registerField(
            $this->createField('72d5f7c0-a49e-4b2e-8af7-57e26b64d981')
                ->on('collections')
                ->name('hidden')
                ->booleanType()
                ->switchInterface()
                ->width('half')
                ->note('[Learn More](https://docs.directus.io/guides/collections.html#hidden).')
        );

        $this->registerField(
            $this->createField('505e9879-ae54-493e-ac97-404e52711676')
                ->on('collections')
                ->name('single')
                ->booleanType()
                ->switchInterface()
                ->width('half')
                ->note('[Learn More](https://docs.directus.io/guides/collections.html#single).')
        );

        $this->registerField(
            $this->createField('de4915a4-c03a-4c09-8d1b-12aa76c8c446')
                ->on('collections')
                ->name('translation')
                ->jsonType()
                ->repeaterInterface([
                    'fields' => [
                        [
                            'field' => 'locale',
                            'type' => 'string',
                            'interface' => 'language',
                            'options' => [
                                'limit' => true,
                            ],
                            'width' => 'half',
                        ],
                        [
                            'field' => 'translation',
                            'type' => 'string',
                            'interface' => 'text-input',
                            'width' => 'half',
                        ],
                    ],
                ])
        );

        $this->registerField(
            $this->createField('d4021a6c-7613-4538-b300-3808a6e14f0d')
                ->on('collections')
                ->name('icon')
                ->stringType()
                ->iconInterface()
                ->note('The icon shown in the App\'s navigation sidebar.')
        );

        $this->registerField(
            $this->createField('26541248-4c2f-4eaa-9cad-4c0ec609142a')
                ->on('fields')
                ->name('id')
                ->uuidType()
                ->required()
                ->textInputInterface([
                    'monospace' => true,
                ])
                ->hidden_detail()
        );

        $this->registerField(
            $this->createField('43633dfd-3a0e-4c7f-ab30-f9e2cb9bda87')
                ->on('fields')
                ->name('collection')
                ->m2oType()
                ->manyToOneInterface()
        );

        $this->registerField(
            $this->createField('e65cd5a3-7611-4384-8a34-8ced421751d8')
                ->on('fields')
                ->name('field')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('537af3cf-9bce-4f10-a125-b89b86e5a0c7')
                ->on('fields')
                ->name('type')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('f080582f-32db-4838-92d1-6534ea51a8ed')
                ->on('fields')
                ->name('interface')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('2ec2c060-000f-4282-a1af-d6d5e939b3d1')
                ->on('fields')
                ->name('options')
                ->jsonType()
                ->jsonInterface()
        );

        $this->registerField(
            $this->createField('ef2458f2-b668-4d41-9d05-f8e659bbc94f')
                ->on('fields')
                ->name('locked')
                ->booleanType()
                ->switchInterface()
        );

        $this->registerField(
            $this->createField('0084c526-0d50-4da1-8089-90003c178e46')
                ->on('fields')
                ->name('translation')
                ->jsonType()
                ->repeaterInterface([
                    'fields' => [
                        [
                            'field' => 'locale',
                            'type' => 'string',
                            'interface' => 'language',
                            'options' => [
                                'limit' => true,
                            ],
                            'width' => 'half',
                        ],
                        [
                            'field' => 'translation',
                            'type' => 'string',
                            'interface' => 'text-input',
                            'width' => 'half',
                        ],
                    ],
                ])
        );

        $this->registerField(
            $this->createField('35cb0f4d-981f-450d-99a4-238bb4f9f1dc')
                ->on('fields')
                ->name('readonly')
                ->booleanType()
                ->switchInterface()
        );

        $this->registerField(
            $this->createField('1713a965-d35d-4ae3-826f-78d05a1368de')
                ->on('fields')
                ->name('validation')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('46485994-bd3d-4a4e-85e3-ac7d40059a1a')
                ->on('fields')
                ->name('required')
                ->booleanType()
                ->switchInterface()
        );

        $this->registerField(
            $this->createField('89671575-bbe6-4c9d-b981-268e6bbf222a')
                ->on('fields')
                ->name('index')
                ->integerType()
                ->sortInterface()
        );

        $this->registerField(
            $this->createField('b13451b5-7b00-44cf-b70c-d718fad476fb')
                ->on('fields')
                ->name('note')
                ->stringType()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('9c900a82-c483-4f13-ba44-fde93a573123')
                ->on('fields')
                ->name('hidden_detail')
                ->booleanType()
                ->switchInterface()
        );

        $this->registerField(
            $this->createField('26454925-3be8-461f-8844-0f753a243beb')
                ->on('fields')
                ->name('hidden_browse')
                ->booleanType()
                ->switchInterface()
        );

        $this->registerField(
            $this->createField('542927eb-92dc-47f9-ae3c-7b2b368da794')
                ->on('fields')
                ->name('width')
                ->integerType()
                ->numericInterface()
        );

        $this->registerField(
            $this->createField('b63f2d9a-3342-4be4-84df-e134b5736171')
                ->on('fields')
                ->name('group_id')
                ->m2oType()
                ->manyToOneInterface()
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $system = Directus::databases()->system();
        $system->collection('fields')->drop();
        $system->collection('collections')->drop();
    }
}
