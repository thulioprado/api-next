<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusSettings extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = directus()->databases()->system();

        $system->schema()->create(
            $system->collection('settings')->name(),
            static function (Blueprint $collection) {
                $collection->string('key')->primary();
                $collection->json('value')->nullable();
            }
        );

        $system->inspector()->table(
            $system->collection('settings')->name()
        )->comment('Directus settings.');
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        directus()->databases()->system()->collection('settings')->drop();
    }
}
