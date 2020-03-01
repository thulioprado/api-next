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
        Schema::create('directus_folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200)->charset('utf8mb4');
            $table->unsignedInteger('parent_folder')->nullable();

            $table->unique(['name', 'parent_folder'], 'idx_name_parent_folder');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_folders');
    }
}
