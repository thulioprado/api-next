<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusUsers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('users')->name(),
            static function (Blueprint $collection) use ($system): void {
                $collection->uuid('id')->primary();
                $collection->uuid('role_id')->nullable();
                $collection->string('status', 32)->default('draft');
                $collection->string('first_name', 50)->nullable();
                $collection->string('last_name', 50)->nullable();
                $collection->string('email')->unique();
                $collection->string('password')->nullable();
                $collection->string('token')->unique()->nullable();
                $collection->string('timezone', 32)->default('America/New_York');
                $collection->string('locale', 8)->nullable();
                $collection->text('locale_options')->nullable();
                $collection->uuid('avatar_id')->nullable();
                $collection->string('company', 200)->nullable();
                $collection->string('title', 200)->nullable();
                $collection->boolean('email_notifications')->default(true);
                $collection->dateTime('last_access_on')->nullable();
                $collection->string('last_page', 200)->nullable();
                $collection->string('external_id')->unique()->nullable();
                $collection->string('theme', 100)->default('auto');
                $collection->string('twofactor_secret', 100)->nullable();
                $collection->string('password_reset_token', 520)->nullable();
                $collection->foreign('role_id')->references('id')->on(
                    $system->collection('roles')->name()
                );
                $collection->foreign('avatar_id')->references('id')->on(
                    $system->collection('files')->name()
                );
            }
        );

        $system->inspector()->table(
            $system->collection('users')->name()
        )->comment('Directus users.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('users')->drop();
    }
}
