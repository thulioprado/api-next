<?php

declare(strict_types=1);

use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\System\Migration;
use Directus\Facades\Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRevisions extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Directus::system()->schema()->create(
            Directus::system()->collection('revisions')->name(),
            function (Blueprint $collection) {
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
                    Directus::system()->collection('activities')->name()
                );
                $collection->foreign('collection_id')->references('id')->on(
                    Directus::system()->collection('collections')->name()
                );
            }
        );

        Directus::fields()->batch(function (FieldsService $fields): void {
            $fields->insert('e5caa751-7a79-4e22-a207-3c42a3add63d')
                ->on('revisions')
                ->name('id')
                ->integer()
            ;
            $fields->insert('3099eac4-91eb-4064-b574-af3927047365')
                ->on('revisions')
                ->name('activity')
                ->m2o()
            ;
            $fields->insert('9f6c2786-02a5-4fff-8af0-0c52972c58c5')
                ->on('revisions')
                ->name('collection')
                ->m2o()
            ;
            $fields->insert('d15a7011-cbd4-48c8-92d4-81f7d72224dc')
                ->on('revisions')
                ->name('item')
                ->string()
            ;
            $fields->insert('215ce72b-54cd-439d-9cfe-e2788aad82a8')
                ->on('revisions')
                ->name('data')
                ->json()
            ;
            $fields->insert('beca1b78-2275-4151-b1c1-9f1900e59d6e')
                ->on('revisions')
                ->name('delta')
                ->json()
            ;
            $fields->insert('1e1d184f-e38c-4786-97b5-e4ffd914a329')
                ->on('revisions')
                ->name('parent_item')
                ->string()
            ;
            $fields->insert('0cbee19f-b82b-4429-8efe-2362949fb657')
                ->on('revisions')
                ->name('parent_collection')
                ->string()
            ;
            $fields->insert('6ccbc80d-ec03-44bb-84dc-2b4d2c054943')
                ->on('revisions')
                ->name('parent_changed')
                ->boolean()
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Directus::system()->collection('revisions')->drop();
    }
}
