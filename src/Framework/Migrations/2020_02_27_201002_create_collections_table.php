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
        Schema::create('directus_collections', function (Blueprint $table) {
            $table->string('collection', 64);
            $table->boolean('managed')->default(true);
            $table->boolean('hidden')->default(false);
            $table->boolean('single')->default(false);
            $table->string('icon', 30)->nullable();
            $table->string('note', 255)->nullable();
            $table->text('translation')->nullable();

            $table->primary('collection');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_collections');
    }
}
