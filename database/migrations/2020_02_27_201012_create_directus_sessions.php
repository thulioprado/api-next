<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusSessions extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('sessions')->name(),
            static function (Blueprint $collection) use ($system) {
                $collection->uuid('id')->primary();
                $collection->uuid('user_id')->nullable();
                $collection->string('token_type', 255)->nullable();
                $collection->string('token', 520)->nullable();
                $collection->string('ip_address', 255)->nullable();
                $collection->text('user_agent')->nullable();
                $collection->dateTime('created_on')->nullable();
                $collection->dateTime('token_expired_at')->nullable();

                $collection->foreign('user_id')->references('id')->on(
                    $system->collection('users')->name()
                );
            }
        );

        $system->inspector()->table(
            $system->collection('sessions')->name()
        )->comment('Directus sessions.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('sessions')->drop();
    }
}
