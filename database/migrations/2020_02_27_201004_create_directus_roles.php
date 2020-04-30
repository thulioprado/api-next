<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRoles extends Migration
{
    use MigrateCollections;
    use MigrateFields;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = Directus::databases()->system();

        $system->schema()->create(
            $system->collection('roles')->name(),
            function (Blueprint $collection) {
                $collection->uuid('id')->primary();
                $collection->string('external_id', 255)->unique()->nullable();
                $collection->string('name', 100)->unique();
                $collection->string('description', 500)->nullable();
                $collection->json('module_listing')->nullable();
                $collection->json('collection_listing')->nullable();
                $collection->text('ip_whitelist')->nullable();
                $collection->boolean('enforce_2fa')->default(false);
            }
        );

        $this->registerCollection('04c67964-7f34-40be-8a9b-2396b8b38db1', 'roles');

        $this->registerField(
            $this->createField('9a683768-36d3-44cb-9f4b-5620af5e161b')
                ->on('roles')
                ->uuidType()
                ->name('id')
                ->required()
                ->hidden_detail()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('08e4468f-d15c-4d3f-bdc0-c6e5c13ce6c9')
                ->on('roles')
                ->stringType()
                ->name('external_id')
                ->readonly()
                ->hidden_detail()
                ->hidden_browse()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('b39fca37-221c-4eff-9bde-cfe721d0a301')
                ->on('roles')
                ->stringType()
                ->name('name')
                ->required()
                ->width('half')
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('11783385-a838-488a-803f-be9f19099a61')
                ->on('roles')
                ->stringType()
                ->name('description')
                ->width('half')
                ->textareaInterface()
        );

        $this->registerField(
            $this->createField('c95f0ddc-fa76-4117-8ff6-51cd29d39979')
                ->on('roles')
                ->jsonType()
                ->name('module_listing')
                ->repeaterInterface([
                    'template' => '{{ name }}',
                    'createItemText' => 'Add Module',
                    'fields' => [
                        [
                            'field' => 'name',
                            'interface' => 'text-input',
                            'type' => 'string',
                            'width' => 'half',
                        ],
                        [
                            'field' => 'link',
                            'interface' => 'text-input',
                            'type' => 'string',
                            'width' => 'half',
                        ],
                        [
                            'field' => 'icon',
                            'interface' => 'icon',
                            'type' => 'string',
                            'width' => 'full',
                        ],
                    ],
                ])
        );

        $this->registerField(
            $this->createField('520906a5-4565-42df-8366-ff8d25acd3d0')
                ->on('roles')
                ->jsonType()
                ->name('collection_listing')
                ->repeaterInterface([
                    'template' => '{{ group_name }}',
                    'createItemText' => 'Add Group',
                    'fields' => [
                        [
                            'field' => 'group_name',
                            'width' => 'full',
                            'interface' => 'text-input',
                            'type' => 'string',
                        ],
                        [
                            'field' => 'collections',
                            'interface' => 'repeater',
                            'type' => 'JSON',
                            'options' => [
                                'createItemText' => 'Add Collection.php',
                                'fields' => [
                                    [
                                        'field' => 'collection',
                                        'type' => 'string',
                                        'interface' => 'collections',
                                        'width' => 'full',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ])
        );

        $this->registerField(
            $this->createField('3b36f33a-ad2b-4519-ab05-a6eaa9092139')
                ->on('roles')
                ->arrayType()
                ->name('ip_whitelist')
                ->tagsInterface([
                    '' => 'Add an IP address...',
                ])
        );

        $this->registerField(
            $this->createField('aaa45485-31e8-4378-b80a-1e1c15138aef')
                ->on('roles')
                ->booleanType()
                ->name('enforce_2fa')
                ->switchInterface()
        );

        // Users
        $this->registerField(
            $this->createField('3c6d1a07-908a-4b5f-9950-5e925549cfa1')
                ->on('roles')
                ->o2mType()
                ->name('users')
                ->oneToManyInterface([
                    'fields' => 'first_name,last_name',
                ])
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('roles');
        Directus::databases()->system()->collection('roles')->drop();
    }
}
