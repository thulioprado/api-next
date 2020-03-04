<?php

declare(strict_types=1);

use Directus\Laravel\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Table name.
     */
    private const TABLE_NAME = 'files';

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection($this->system())->create($this->table(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->unsignedBigInteger('folder_id')->nullable();

            // Information
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('type', 255)->nullable();
            $table->integer('filesize')->unsigned()->default(0);
            $table->integer('width')->unsigned()->nullable();
            $table->integer('height')->unsigned()->nullable();
            $table->integer('duration')->nullable();

            // Store
            $table->string('storage', 50)->default('local');
            $table->string('filename_disk', 255);
            $table->string('filename_download', 255);

            // Settings
            $table->string('charset', 50)->nullable();
            $table->string('embed', 200)->nullable();
            $table->string('location', 200)->nullable();
            $table->string('tags', 255)->nullable();
            $table->text('metadata')->nullable();

            // Validations
            $table->string('private_hash', 16)->nullable();
            $table->string('checksum', 32)->nullable();

            // Track
            $table->integer('uploaded_by')->unsigned();
            $table->dateTime('uploaded_on');

            // Relations
            $table->foreign('folder_id')->references('id')->on('folders');
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
