<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('name', 200)->charset('utf8mb4');

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
        Schema::dropIfExists('folders');
    }
}
