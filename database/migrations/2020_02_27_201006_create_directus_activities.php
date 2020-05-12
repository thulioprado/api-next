<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusActivities extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('activities')->name(),
            static function (Blueprint $collection) use ($system): void {
                $collection->uuid('id')->primary();
                $collection->uuid('collection_id');
                $collection->string('action', 45);
                $collection->uuid('action_by')->nullable();
                $collection->dateTime('action_on')->nullable();
                $collection->ipAddress('ip');
                $collection->string('user_agent', 255);
                $collection->json('item');
                $collection->dateTime('edited_on')->nullable();
                $collection->text('comment')->nullable();
                $collection->dateTime('comment_deleted_on')->nullable();
                $collection->foreign('collection_id')->references('id')->on(
                    $system->collection('collections')->name()
                );
                $collection->foreign('action_by')->references('id')->on(
                    $system->collection('users')->name()
                );
            }
        );

        $system->inspector()->table(
            $system->collection('activities')->name()
        )->comment('Directus activities.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('activities')->drop();
    }
}
