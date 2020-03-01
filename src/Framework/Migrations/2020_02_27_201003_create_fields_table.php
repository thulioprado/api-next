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
        Schema::create('directus_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('collection', 64);
            $table->string('field', 64);
            $table->string('type', 64);
            $table->string('interface', 64);
            $table->text('options')->nullable();
            $table->boolean('locked')->default(false);
            $table->boolean('required')->default(false);
            $table->boolean('readonly')->default(false);
            $table->boolean('hidden_detail')->default(false);
            $table->boolean('hidden_browse')->default(false);
            $table->integer('sort')->unsigned()->nullable();
            $table->string('width', 50)->default('full');
            $table->integer('group')->unsigned()->nullable();
            $table->string('note', 1024)->nullable();
            $table->text('translation')->nullable();

            $table->unique(['collection', 'field'], 'idx_collection_field');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_fields');
    }
}
