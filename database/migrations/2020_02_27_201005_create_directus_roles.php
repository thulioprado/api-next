<?php

declare(strict_types=1);

use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\System\Migration;
use Directus\Facades\Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRoles extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Directus::system()->schema()->create(
            Directus::system()->collection('roles')->name(),
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

        Directus::system()->collections()->register(
            Directus::system()->collection('roles')->fullName(),
            '04c67964-7f34-40be-8a9b-2396b8b38db1'
        );

        Directus::fields()->batch(function (FieldsService $fields) {
            $fields->insert('9a683768-36d3-44cb-9f4b-5620af5e161b', 0)
                ->on('roles')
                ->string()
                ->name('id')
                ->required()
                ->hidden_detail()
                ->textInputInterface([
                    'monospace' => true,
                ])
            ;

            $fields->insert('08e4468f-d15c-4d3f-bdc0-c6e5c13ce6c9', 1)
                ->on('roles')
                ->string()
                ->name('external_id')
                ->readonly()
                ->hidden_detail()
                ->hidden_browse()
                ->textInputInterface()
            ;

            $fields->insert('b39fca37-221c-4eff-9bde-cfe721d0a301', 2)
                ->on('roles')
                ->string()
                ->name('name')
                ->required()
                ->width('half')
                ->textInputInterface()
            ;

            $fields->insert('11783385-a838-488a-803f-be9f19099a61', 3)
                ->on('roles')
                ->string()
                ->name('description')
                ->width('half')
                ->textareaInterface()
            ;

            $fields->insert('c95f0ddc-fa76-4117-8ff6-51cd29d39979', 4)
                ->on('roles')
                ->json()
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
            ;

            $fields->insert('520906a5-4565-42df-8366-ff8d25acd3d0', 5)
                ->on('roles')
                ->json()
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
            ;

            $fields->insert('3b36f33a-ad2b-4519-ab05-a6eaa9092139', 6)
                ->on('roles')
                ->array()
                ->name('ip_whitelist')
                ->tagsInterface([
                    '' => 'Add an IP address...',
                ])
            ;

            $fields->insert('aaa45485-31e8-4378-b80a-1e1c15138aef', 7)
                ->on('roles')
                ->boolean()
                ->name('enforce_2fa')
                ->switchInterface()
            ;

            // Users
            $fields->insert('3c6d1a07-908a-4b5f-9950-5e925549cfa1', 8)
                ->on('roles')
                ->o2m()
                ->name('users')
                ->oneToManyInterface([
                    'fields' => 'first_name,last_name',
                ])
            ;
        });
    }

    public function down()
    {
        Directus::fields()->from(Directus::system()->collection('roles')->fullName())->delete();
        Directus::system()->collection('roles')->drop();
    }
}
