<?php

declare(strict_types=1);

use Directus\Laravel\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionsTable extends Migration
{
    /**
     * Table name.
     */
    private const TABLE_NAME = 'revisions';

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection($this->system())->create($this->table(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->unsignedBigInteger('activity_id');
            $table->string('collection_id', 64);

            // Information
            $table->string('item', 255);
            $table->longText('data');
            $table->longText('delta')->nullable();

            // Parent
            $table->string('parent_collection', 64)->nullable();
            $table->string('parent_item', 255)->nullable();
            $table->boolean('parent_changed')->default(false);

            // Relations
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('collection_id')->references('name')->on('collections');
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
