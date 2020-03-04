<?php

declare(strict_types=1);

use Directus\Laravel\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSessionsTable extends Migration
{
    /**
     * Table name.
     */
    private const TABLE_NAME = 'user_sessions';

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection($this->system())->create($this->table(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();

            // Settings
            $table->string('token_type', 255)->nullable();
            $table->string('token', 520)->nullable();
            $table->dateTime('token_expired_at')->nullable();

            // Track
            $table->string('ip_address', 255)->nullable();
            $table->text('user_agent')->nullable();

            // Metric
            $table->dateTime('created_on')->nullable();

            // Relations
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists($this->table(self::TABLE_NAME));
    }
}
