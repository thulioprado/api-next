<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMigrationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('migrations', function (Blueprint $table) {
            // Identification
            $table->bigInteger('version')->primary();
            $table->string('migration_name', 100)->nullable();

            // Metrics
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();

            // Settings
            $table->boolean('breakpoint')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('migrations');
    }
}
