<?php

declare(strict_types=1);

use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\System\Migration;
use Directus\Facades\Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusWebhooks extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Directus::system()->schema()->create(
            Directus::system()->collection('webhooks')->name(),
            function (Blueprint $collection) {
                $collection->bigIncrements('id');
                $collection->string('status', 16)->default('inactive');
                $collection->string('http_action', 255)->nullable();
                $collection->string('url', 510)->nullable();
                $collection->uuid('collection_id')->nullable();
                $collection->string('directus_action', 255)->nullable();

                $collection->foreign('collection_id')->references('id')->on(
                    Directus::system()->collection('collections')->name()
                );
            }
        );

        Directus::fields()->batch(function (FieldsService $fields): void {
            $fields->insert('8b5f0a59-6fcf-45fc-9a71-203bc6ddda7d')
                ->on('webhooks')
                ->name('id')
                ->integer()
                ->hidden_detail()
            ;

            $fields->insert('bca9d609-ac5a-482a-9bdd-d84282a102f5')
                ->on('webhooks')
                ->name('status')
                ->status()
                ->options([
                    'status_mapping' => [
                        'active' => [
                            'name' => 'Active',
                            'value' => 'active',
                            'text_color' => 'white',
                            'background_color' => 'green',
                            'browse_subdued' => false,
                            'browse_badge' => true,
                            'soft_delete' => false,
                            'published' => true,
                        ],
                        'inactive' => [
                            'name' => 'Inactive',
                            'value' => 'inactive',
                            'text_color' => 'white',
                            'background_color' => 'blue-grey',
                            'browse_subdued' => true,
                            'browse_badge' => true,
                            'soft_delete' => false,
                            'published' => false,
                        ],
                    ],
                ])
            ;

            $fields->insert('a43bed03-0ce8-44c1-b66b-ed91f1854050')
                ->on('webhooks')
                ->name('http_action')
                ->string()
                ->required()
                ->options([
                    'choices' => [
                        'get' => 'GET',
                        'post' => 'POST',
                    ],
                ])
                ->width('half-space')
            ;

            $fields->insert('ac071d90-0ce0-47a4-b82e-b0f438d0ed60')
                ->on('webhooks')
                ->name('url')
                ->string()
                ->options([
                    'placeholder' => 'https://example.com',
                    'iconRight' => 'link',
                ])
                ->required()
            ;

            $fields->insert('e4fc8565-3ffa-457e-8d5d-e618b9d546c2')
                ->on('webhooks')
                ->name('collection_id')
                ->string()
                ->required()
            ;

            $fields->insert('26e870bf-2748-4f0b-8484-59499922eeb0')
                ->on('webhooks')
                ->name('directus_action')
                ->string()
                ->required()
                ->options([
                    'choices' => [
                        'item.create:after' => 'Create',
                        'item.update:after' => 'Update',
                        'item.delete:after' => 'Delete',
                    ],
                ])
            ;

            $fields->insert('c8d08500-0ea6-4a20-8ee7-774aa4c2ce08')
                ->on('webhooks')
                ->name('info')
                ->alias()
                ->options([
                    'style' => 'medium',
                    'title' => 'How Webhooks Work',
                    'hr' => true,
                    'margin' => false,
                    'description' => 'When the selected action occurs for the selected collection, Directus will send an HTTP request to the above URL.',
                ])
                ->hidden_browse()
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Directus::system()->collection('webhooks')->drop();
    }
}
