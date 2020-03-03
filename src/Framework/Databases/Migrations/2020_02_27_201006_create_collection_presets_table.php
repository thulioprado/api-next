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
        Schema::create('collection_presets', function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('collection_id', 64);

            // Information
            $table->string('title', 255)->charset('utf8mb4')->nullable();
            $table->string('search_query', 100)->nullable();
            $table->text('filters')->nullable();

            // Settings
            $table->string('view_type', 100)->default('tabular');
            $table->text('view_query')->nullable();
            $table->text('view_options')->nullable();

            // Internationalization
            $table->text('translation')->nullable();

            // Relations
            $table->unique(['user_id', 'collection_id', 'title'], 'idx_user_collection_title');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('collection_id')->references('name')->on('collections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('collection_presets');
    }
}
