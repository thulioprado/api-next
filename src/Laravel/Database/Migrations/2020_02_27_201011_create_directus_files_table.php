<?php

declare(strict_types=1);

use Directus\Laravel\Database\Traits\SystemBuilder;
use Directus\Laravel\Database\Traits\TableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusFilesTable extends Migration
{
    use SystemBuilder;
    use TableName;

    /**
     * Table name.
     */
    private const TABLE_NAME = 'files';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->tableName(self::TABLE_NAME), function (Blueprint $table) {
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
        $this->system()->dropIfExists($this->tableName(self::TABLE_NAME));
    }
}
