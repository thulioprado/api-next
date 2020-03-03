<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('collection_id', 64);

            // Shape
            $table->string('field', 64);
            $table->string('type', 64);
            $table->string('interface', 64);
            $table->json('options')->nullable();

            // Settings
            $table->boolean('locked')->default(false);
            $table->boolean('required')->default(false);
            $table->boolean('readonly')->default(false);
            $table->boolean('hidden_detail')->default(false);
            $table->boolean('hidden_browse')->default(false);
            $table->integer('sort')->unsigned()->nullable();
            $table->integer('group')->unsigned()->nullable();
            $table->string('width', 50)->default('full');
            $table->string('note', 1024)->nullable();

            // Internationalization
            $table->json('translation')->nullable();

            // Keys
            $table->unique(['collection', 'field']);

            // Relations
            $table->foreign('collection_id')->references('name')->on('collections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
}
