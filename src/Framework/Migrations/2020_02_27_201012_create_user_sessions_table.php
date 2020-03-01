<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSessionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_user_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user')->nullable();
            $table->string('token_type', 255)->nullable();
            $table->string('token', 520)->nullable();
            $table->string('ip_address', 255)->nullable();
            $table->text('user_agent')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->dateTime('token_expired_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_user_sessions');
    }
}
