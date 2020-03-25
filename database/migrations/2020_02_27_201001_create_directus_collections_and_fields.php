<?php

declare(strict_types=1);

use Directus\Database\System\Migration;
use Directus\Facades\Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusCollectionsAndFields extends Migration
{
    /**
     * Migration.
     */
    public function up(): void
    {
        // CollectionsService

        Directus::system()->schema()->create(
            Directus::system()->collection('collections')->name(),
            function (Blueprint $collection): void {
                $collection->uuid('id')->primary();
                $collection->string('name', 128)->unique();
                $collection->boolean('managed')->default(true);
                $collection->boolean('hidden')->default(false);
                $collection->boolean('single')->default(false);
                $collection->boolean('system')->default(false);
                $collection->string('icon', 30)->nullable();
                $collection->string('note', 255)->nullable();
                $collection->json('translation')->nullable();
            }
        );

        Directus::collections()->register(
            Directus::system()->collection('collections')->fullName(),
            'b0b202dd-3cdc-480d-8deb-1db2c543f973'
        );

        // Fields

        Directus::system()->schema()->create(
            Directus::system()->collection('fields')->name(),
            function (Blueprint $collection): void {
                $collection->uuid('id');
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
                $collection->bigInteger('group')->nullable();
                $collection->string('note', 1024)->nullable();
                $collection->json('translation')->nullable();
                $collection->unique(['collection_id', 'name']);
                $collection->foreign('collection_id')->references('id')->on(
                    Directus::system()->collection('collections')->name()
                );
            }
        );

        Directus::collections()->register(
            Directus::system()->collection('fields')->fullName(),
            'b03b7c91-3aa9-473c-b677-e8ab6f19b7d3'
        );

        // Collection fields

        $this->registerField('f6ce0656-2237-4128-8ab8-5c8c0ee74d71', 'collections', 'fields', 'o2m', 'one-to-many', [
            'hidden_detail' => true,
            'hidden_browse' => true,
        ]);

        $this->registerField('a05e6938-be1e-4d34-8c94-a6c7649a9f05', 'collections', 'collection', 'string', 'primary-key', [
            'readonly' => true,
            'width' => 'half',
        ]);

        $this->registerField('d09911f2-8d0e-44df-8d17-8a4268925adb', 'collections', 'note', 'string', 'text-input', [
            'width' => 'half',
            'note' => 'An internal description.',
        ]);

        $this->registerField('c4a9e06a-29ce-49aa-9b09-d31354a460d2', 'collections', 'managed', 'boolean', 'switch', [
            'width' => 'half',
            'hidden_detail' => true,
            'note' => '[Learn More](https://docs.directus.io/guides/collections.html#managing-collections).',
        ]);

        $this->registerField('72d5f7c0-a49e-4b2e-8af7-57e26b64d981', 'collections', 'hidden', 'boolean', 'switch', [
            'width' => 'half',
            'note' => '[Learn More](https://docs.directus.io/guides/collections.html#hidden).',
        ]);

        $this->registerField('505e9879-ae54-493e-ac97-404e52711676', 'collections', 'single', 'boolean', 'switch', [
            'width' => 'half',
            'note' => '[Learn More](https://docs.directus.io/guides/collections.html#single).',
        ]);

        $this->registerField('de4915a4-c03a-4c09-8d1b-12aa76c8c446', 'collections', 'translation', 'json', 'repeater', [
            'hidden_detail' => false,
            'options' => [
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
            ],
        ]);

        $this->registerField('d4021a6c-7613-4538-b300-3808a6e14f0d', 'collections', 'icon', 'string', 'icon', [
            'note' => 'The icon shown in the App\'s navigation sidebar.',
        ]);

        // Fields fields

        $this->registerField('26541248-4c2f-4eaa-9cad-4c0ec609142a', 'fields', 'id', 'integer', 'primary-key', [
            'hidden_detail' => true,
        ]);
        $this->registerField('43633dfd-3a0e-4c7f-ab30-f9e2cb9bda87', 'fields', 'collection', 'm2o', 'many-to-one');
        $this->registerField('e65cd5a3-7611-4384-8a34-8ced421751d8', 'fields', 'field', 'string', 'text-input');
        $this->registerField('537af3cf-9bce-4f10-a125-b89b86e5a0c7', 'fields', 'type', 'string', 'primary-key');
        $this->registerField('f080582f-32db-4838-92d1-6534ea51a8ed', 'fields', 'interface', 'string', 'primary-key');
        $this->registerField('2ec2c060-000f-4282-a1af-d6d5e939b3d1', 'fields', 'options', 'json', 'json');
        $this->registerField('ef2458f2-b668-4d41-9d05-f8e659bbc94f', 'fields', 'locked', 'boolean', 'switch');
        $this->registerField('0084c526-0d50-4da1-8089-90003c178e46', 'fields', 'translation', 'json', 'repeater', [
            'options' => [
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
            ],
        ]);
        $this->registerField('35cb0f4d-981f-450d-99a4-238bb4f9f1dc', 'fields', 'readonly', 'boolean', 'switch');
        $this->registerField('1713a965-d35d-4ae3-826f-78d05a1368de', 'fields', 'validation', 'string', 'text-input');
        $this->registerField('46485994-bd3d-4a4e-85e3-ac7d40059a1a', 'fields', 'required', 'boolean', 'switch');
        $this->registerField('89671575-bbe6-4c9d-b981-268e6bbf222a', 'fields', 'index', 'integer', 'sort');
        $this->registerField('b13451b5-7b00-44cf-b70c-d718fad476fb', 'fields', 'note', 'string', 'text-input');
        $this->registerField('9c900a82-c483-4f13-ba44-fde93a573123', 'fields', 'hidden_detail', 'boolean', 'switch');
        $this->registerField('26454925-3be8-461f-8844-0f753a243beb', 'fields', 'hidden_browse', 'boolean', 'switch');
        $this->registerField('542927eb-92dc-47f9-ae3c-7b2b368da794', 'fields', 'width', 'integer', 'numeric');
        $this->registerField('b63f2d9a-3342-4be4-84df-e134b5736171', 'fields', 'group', 'm2o', 'many-to-one');
    }

    /**
     * Drop the migration.
     */
    public function down(): void
    {
        Directus::system()->collection('fields')->drop();
        Directus::system()->collection('collections')->drop();
    }
}
