<?php

declare(strict_types=1);

use Directus\Laravel\Database\Traits\SystemBuilder;
use Directus\Laravel\Database\Traits\TableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusCollectionsTable extends Migration
{
    use SystemBuilder;
    use TableName;

    /**
     * Table name.
     */
    private const TABLE_NAME = 'collections';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->tableName(self::TABLE_NAME), function (Blueprint $table) {
            // Information
            $table->string('name', 64)->primary();
            $table->string('icon', 30)->nullable();
            $table->string('note', 255)->nullable();

            // Internationalization
            $table->json('translation')->nullable();

            // Settings
            $table->boolean('managed')->default(true);
            $table->boolean('hidden')->default(false);
            $table->boolean('single')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->system()->dropIfExists($this->tableName(self::TABLE_NAME));
    }
}
