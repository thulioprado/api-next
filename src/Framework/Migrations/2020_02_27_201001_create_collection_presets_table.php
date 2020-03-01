<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionPresetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_collection_presets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255)->charset('utf8mb4')->nullable();
            $table->integer('user')->unsigned()->nullable();
            $table->integer('role')->unsigned()->nullable();
            $table->string('collection', 64);
            $table->string('search_query', 100)->nullable();
            $table->text('filters')->nullable();
            $table->string('view_type', 100)->default('tabular');
            $table->text('view_query')->nullable();
            $table->text('view_options')->nullable();
            $table->text('translation')->nullable();
            $table->unique(['user', 'collection', 'title'], 'idx_user_collection_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_collection_presets');
    }
}
