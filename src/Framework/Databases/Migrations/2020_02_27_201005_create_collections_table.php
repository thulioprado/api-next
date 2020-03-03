<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            // Information
            $table->string('name', 64)->primary();
            $table->string('icon', 30)->nullable();
            $table->string('note', 255)->nullable();

            // Internationalization
            $table->json('translation')->nullable();

            // Settings
            $table->boolean('managed')->default(true);
            $table->boolean('hidden')->default(false);
            $table->boolean('single')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
