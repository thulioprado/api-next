<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusFiles extends Migration
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
            $system->collection('files')->name(),
            function (Blueprint $collection) use ($system) {
                $collection->uuid('id')->primary();
                $collection->string('storage', 50)->default('local');
                $collection->string('private_hash', 16)->nullable();
                $collection->string('filename_disk', 255);
                $collection->string('filename_download', 255);
                $collection->string('title', 255)->nullable();
                $collection->string('type', 255)->nullable();
                $collection->uuid('uploaded_by_id');
                $collection->dateTime('uploaded_on'); // TODO: default current timestamp
                $collection->string('charset', 50)->nullable();
                $collection->integer('filesize')->unsigned()->default(0);
                $collection->integer('width')->unsigned()->nullable();
                $collection->integer('height')->unsigned()->nullable();
                $collection->integer('duration')->nullable();
                $collection->string('embed', 200)->nullable();
                $collection->uuid('folder_id')->nullable();
                $collection->text('description')->nullable();
                $collection->string('location', 200)->nullable();
                $collection->string('tags', 255)->nullable();
                $collection->string('checksum', 32)->nullable();
                $collection->text('metadata')->nullable();
                $collection->foreign('folder_id')->references('id')->on(
                    $system->collection('folders')->name()
                );
                /*
                // TODO: This is a cross reference, how to deal with it?
                $collection->foreign('uploaded_by_id')->references('id')->on(
                    $system->collection('users')->name()
                );
                */
            }
        );

        $this->registerCollection('6ecf28db-6902-45a4-b899-d4960e0ab78c', 'files');

        $this->registerField(
            $this->createField('5d8bbe64-b9be-4a47-905d-4c4e583a98f4')
                ->on('files')
                ->name('preview')
                ->alias()
                ->filePreviewInterface()
        );

        $this->registerField(
            $this->createField('4b052061-b0d3-4e52-8043-989dbbc9f6a3')
                ->on('files')
                ->name('title')
                ->string()
                ->textInputInterface([
                    'placeholder' => 'Enter a descriptive title...',
                    'iconRight' => 'title',
                ])
        );

        $this->registerField(
            $this->createField('927ba058-fef8-44ab-aeb8-fa8e9531ba0b')
                ->on('files')
                ->name('tags')
                ->array()
                ->tagsInterface([
                    'placeholder' => 'Enter a keyword then hit enter...',
                ])
                ->width('half')
        );

        $this->registerField(
            $this->createField('c7d6ea04-c7d9-47fa-a34d-73cceabecbf9')
                ->on('files')
                ->name('location')
                ->string()
                ->textInputInterface([
                    'placeholder' => 'Enter a location...',
                    'iconRight' => 'place',
                ])
                ->width('half')
        );

        $this->registerField(
            $this->createField('49a42490-a6ed-47dd-b4a2-dc40b1a151fb')
                ->on('files')
                ->name('description')
                ->string()
                ->wysiwygInterface([
                    'toolbar' => [
                        'bold',
                        'italic',
                        'underline',
                        'link',
                        'code',
                    ],
                ])
        );

        $this->registerField(
            $this->createField('9dbf2b88-9522-45d7-9040-865316847abf')
                ->on('files')
                ->name('filename_download')
                ->string()
                ->textInputInterface([
                    'monospace' => true,
                    'iconRight' => 'get_app',
                ])
        );

        $this->registerField(
            $this->createField('aebe748c-3c56-4a6a-b7fb-a17c8c029023')
                ->on('files')
                ->name('filename_disk')
                ->string()
                ->textInputInterface([
                    'placeholder' => 'Enter a unique file name...',
                    'iconRight' => 'insert_drive_file',
                ])
        );

        $this->registerField(
            $this->createField('dc817b60-26a9-4c82-8770-8fb47f427cd7')
                ->on('files')
                ->name('private_hash')
                ->string()
                ->width('half')
                ->slugInterface([
                    'iconRight' => 'lock',
                ])
        );

        $this->registerField(
            $this->createField('6d44d7e6-a943-4299-be14-a389afe05838')
                ->on('files')
                ->name('checksum')
                ->string()
                ->readonly()
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'check',
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('94ed71e0-9129-493a-96b9-447784b0f465')
                ->on('files')
                ->name('uploaded_on')
                ->datetime()
                ->datetimeInterface([
                    'iconRight' => 'today',
                ])
                ->required()
                ->readonly()
                ->width('half')
        );

        $this->registerField(
            $this->createField('227e1a29-91c6-46ca-8867-93803ac4bcc2')
                ->on('files')
                ->name('uploaded_by')
                ->owner()
                ->required()
                ->readonly()
                ->width('half')
                ->ownerInterface()
        );

        $this->registerField(
            $this->createField('b5a876e2-5f9d-46d8-8107-2f8f67423134')
                ->on('files')
                ->name('width')
                ->integer()
                ->numericInterface([
                    'iconRight' => 'straighten',
                ])
                ->readonly()
                ->width('half')
        );

        $this->registerField(
            $this->createField('98fd63a5-8e8c-4bd2-a6a0-3706da08fedf')
                ->on('files')
                ->name('height')
                ->integer()
                ->numericInterface([
                    'iconRight' => 'straighten',
                ])
                ->readonly()
                ->width('half')
        );

        $this->registerField(
            $this->createField('ee7da3bf-d11e-4651-b09a-10fe90a7b950')
                ->on('files')
                ->name('duration')
                ->integer()
                ->numericInterface([
                    'iconRight' => 'timer',
                ])
                ->readonly()
                ->width('half')
        );

        $this->registerField(
            $this->createField('79c9ec54-6504-4030-8276-dc928f8aca07')
                ->on('files')
                ->name('filesize')
                ->integer()
                ->fileSizeInterface([
                    'iconRight' => 'storage',
                ])
                ->readonly()
                ->width('half')
        );

        $this->registerField(
            $this->createField('4276a353-3a70-4d72-81b5-6ac4d0328d8b')
                ->on('files')
                ->name('metadata')
                ->json()
                ->keyValueInterface([
                    'keyInterface' => 'text-input',
                    'keyDataType' => 'string',
                    'keyOptions' => [
                        'monospace' => true,
                        'placeholder' => 'Key',
                    ],
                    'valueInterface' => 'text-input',
                    'valueDataType' => 'string',
                    'valueOptions' => [
                        'monospace' => true,
                        'placeholder' => 'Value',
                    ],
                ])
        );

        $this->registerField(
            $this->createField('21980180-a867-4e9a-9d5d-97bfe305c0ac')
                ->on('files')
                ->name('data')
                ->alias()
                ->hidden_detail()
                ->fileInterface()
        );

        $this->registerField(
            $this->createField('325f3699-e999-420f-9a43-654ff8f1b15e')
                ->on('files')
                ->name('id')
                ->uuid()
                ->required()
                ->hidden_detail()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('2fc3aecc-ebc4-4d1e-b331-df27566f5935')
                ->on('files')
                ->name('type')
                ->string()
                ->readonly()
                ->hidden_detail()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('c967bf30-e50e-4d7a-bac9-6088770cc3d5')
                ->on('files')
                ->name('charset')
                ->string()
                ->readonly()
                ->hidden_detail()
                ->hidden_browse()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('ff58fcfe-5f7e-4da8-999c-3a9b96f5a799')
                ->on('files')
                ->name('embed')
                ->string()
                ->readonly()
                ->hidden_detail()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('28481575-7d8a-4067-a418-ee5c0822e7b4')
                ->on('files')
                ->name('folder')
                ->m2o()
                ->hidden_detail()
                ->manyToOneInterface()
        );

        $this->registerField(
            $this->createField('a3e1953a-ac72-45a3-aa68-8b22fa4aa20e')
                ->on('files')
                ->name('storage')
                ->string()
                ->hidden_detail()
                ->hidden_browse()
                ->textInputInterface()
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('files');
        Directus::databases()->system()->collection('files')->drop();
    }
}
