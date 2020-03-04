<?php

declare(strict_types=1);

use Directus\Laravel\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Table name.
     */
    private const TABLE_NAME = 'folders';

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection($this->system())->create($this->table(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('name', 200);

            // Subdirectory
            $table->unsignedBigInteger('parent_folder')->nullable();

            // Keys
            $table->unique(['name', 'parent_folder']);

            // Relations
            $table->foreign('parent_folder')->references('id')->on('folders');
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
