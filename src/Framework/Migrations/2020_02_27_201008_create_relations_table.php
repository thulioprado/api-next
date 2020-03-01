<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
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
        Schema::dropIfExists('directus_relations');
    }
}
