<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('storage', 50)->default('local');
            $table->string('private_hash', 16)->nullable();
            $table->string('filename_disk', 255);
            $table->string('filename_download', 255);
            $table->string('title', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->integer('uploaded_by')->unsigned();
            $table->dateTime('uploaded_on');
            $table->string('charset', 50)->nullable();
            $table->integer('filesize')->unsigned()->default(0);
            $table->integer('width')->unsigned()->nullable();
            $table->integer('height')->unsigned()->nullable();
            $table->integer('duration')->nullable();
            $table->string('embed', 200)->nullable();
            $table->integer('folder')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->string('location', 200)->nullable();
            $table->string('tags', 255)->nullable();
            $table->string('checksum', 32)->nullable();
            $table->text('metadata')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_files');
    }
}
