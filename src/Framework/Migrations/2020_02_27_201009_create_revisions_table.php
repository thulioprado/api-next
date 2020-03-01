<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_revisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('activity');
            $table->string('collection', 64);
            $table->string('item', 255);
            $table->longText('data');
            $table->longText('delta')->nullable();
            $table->string('parent_collection', 64)->nullable();
            $table->string('parent_item', 255)->nullable();
            $table->unsignedTinyInteger('parent_changed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_revisions');
    }
}
