<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusPermissions extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('permissions')->name(),
            static function (Blueprint $collection) use ($system) {
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
            }
        );

        $system->inspector()->table(
            $system->collection('permissions')->name()
        )->comment('Directus permissions.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('permissions')->drop();
    }
}
