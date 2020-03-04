<?php

declare(strict_types=1);

use Directus\Laravel\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Table name.
     */
    private const TABLE_NAME = 'relations';

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection($this->system())->create($this->table(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');

            // Information
            $table->string('collection_many', 64);
            $table->string('field_many', 45);
            $table->string('collection_one', 64);
            $table->string('field_one', 64);
            $table->string('junction_field', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists($this->table(self::TABLE_NAME));
    }
}
