<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusWebhooks extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('webhooks')->name(),
            static function (Blueprint $collection) use ($system) {
                $collection->uuid('id')->primary();
                $collection->string('status', 16)->default('inactive');
                $collection->string('http_action', 255)->nullable();
                $collection->string('url', 510)->nullable();
                $collection->uuid('collection_id')->nullable();
                $collection->string('directus_action', 255)->nullable();

                $collection->foreign('collection_id')->references('id')->on(
                    $system->collection('collections')->name()
                );
            }
        );

        $system->inspector()->table(
            $system->collection('webhooks')->name()
        )->comment('Directus webhooks.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('webhooks')->drop();
    }
}
