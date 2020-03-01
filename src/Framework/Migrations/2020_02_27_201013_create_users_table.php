<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status', 16)->default('draft');
            $table->integer('role')->nullable();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email', 128);
            $table->string('password', 255)->nullable();
            $table->string('token', 255)->nullable();
            $table->string('timezone', 32)->default('America/New_York');
            $table->string('locale', 8)->nullable();
            $table->text('locale_options')->nullable();
            $table->unsignedInteger('avatar')->nullable();
            $table->string('company', 200)->nullable();
            $table->string('title', 200)->nullable();
            $table->boolean('email_notifications')->default(true);
            $table->dateTime('last_access_on')->nullable();
            $table->string('last_page', 200)->nullable();
            $table->string('external_id', 255)->nullable();
            $table->string('theme', 100)->default('auto');
            $table->string('2fa_secret', 100)->nullable();
            $table->string('password_reset_token', 520)->nullable();

            $table->unique('email', 'idx_users_email');
            $table->unique('token', 'idx_users_token');
            $table->unique('external_id', 'idx_users_external_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_users');
    }
}
