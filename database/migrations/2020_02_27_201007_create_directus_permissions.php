<?php

declare(strict_types=1);

use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\System\Migration;
use Directus\Facades\Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusPermissions extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Directus::system()->schema()->create(
            Directus::system()->collection('permissions')->name(),
            function (Blueprint $collection) {
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
                    Directus::system()->collection('collections')->name()
                );

                $collection->foreign('role_id')->references('id')->on(
                    Directus::system()->collection('roles')->name()
                );
            },
        );

        Directus::fields()->batch(function (FieldsService $fields): void {
            $fields->insert('2195a3ee-169a-4789-933c-3da8b2236373')
                ->on('permissions')
                ->name('id')
                ->integer()
                ->required()
                ->hidden_detail()
            ;
            $fields->insert('dacc517e-4295-47e4-ba63-9bc0baaa809f')
                ->on('permissions')
                ->name('collection_id')
                ->m2o()
            ;
            $fields->insert('573ad421-4868-4799-af0b-78205054cb39')
                ->on('permissions')
                ->name('role_id')
                ->m2o()
            ;
            $fields->insert('23b8f393-8c36-467e-81b6-00f7ed5656c0')
                ->on('permissions')
                ->name('status')
                ->string()
            ;
            $fields->insert('ee5f6a76-14e4-470e-86ba-621a5953e789')
                ->on('permissions')
                ->name('create')
                ->string()
            ;
            $fields->insert('57bc5bb4-81cd-4a54-8511-de057daa1c29')
                ->on('permissions')
                ->name('read')
                ->string()
            ;
            $fields->insert('8510ac8a-0a19-4f4f-ac4a-b81832d23023')
                ->on('permissions')
                ->name('update')
                ->string()
            ;
            $fields->insert('c083c02c-330c-47d9-84a5-d295aa59a57c')
                ->on('permissions')
                ->name('delete')
                ->string()
            ;
            $fields->insert('30ea7caa-394d-4bb4-a741-9ce4bd9fa901')
                ->on('permissions')
                ->name('comment')
                ->string()
            ;
            $fields->insert('36004f1e-e302-4c8f-87d6-bf5266c5e019')
                ->on('permissions')
                ->name('explain')
                ->string()
            ;
            $fields->insert('2e9b0688-4993-4052-9382-f1587b00081e')
                ->on('permissions')
                ->name('status_blacklist')
                ->array()
            ;
            $fields->insert('21b2cbb9-d056-4445-8a63-e03c4106ec2d')
                ->on('permissions')
                ->name('read_field_blacklist')
                ->array()
            ;
            $fields->insert('b901a97e-4ab6-4c94-b0e2-af2aa772a48d')
                ->on('permissions')
                ->name('write_field_blacklist')
                ->array()
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Directus::system()->collection('permissions')->drop();
    }
}
