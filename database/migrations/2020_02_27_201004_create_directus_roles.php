<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRoles extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('roles')->name(),
            static function (Blueprint $collection) {
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

        $system->inspector()->table(
            $system->collection('roles')->name()
        )->comment('Directus roles.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('roles')->drop();
    }
}
