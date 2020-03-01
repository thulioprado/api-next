<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 64);
            $table->text('value')->nullable();

            $table->unique('key', 'idx_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_settings');
    }
}
