<?php

declare(strict_types=1);

use Directus\Laravel\Database\Traits\SystemBuilder;
use Directus\Laravel\Database\Traits\TableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusUsersTable extends Migration
{
    use SystemBuilder;
    use TableName;

    /**
     * Table name.
     */
    private const TABLE_NAME = 'users';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->tableName(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('external_id', 255)->unique()->nullable();
            $table->unsignedBigInteger('avatar_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();

            // Basic information
            $table->string('status', 16)->default('draft');
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email', 130)->unique();
            $table->string('password', 255)->nullable();
            $table->string('password_reset_token', 520)->nullable();
            $table->string('token', 255)->unique()->nullable();
            $table->string('title', 200)->nullable();
            $table->string('company', 200)->nullable();

            // Settings
            $table->string('timezone', 32)->default('America/New_York');
            $table->string('theme', 100)->default('auto');
            $table->string('2fa_secret', 100)->nullable();
            $table->string('locale', 8)->nullable();
            $table->json('locale_options')->nullable();
            $table->string('last_page', 200)->nullable();
            $table->dateTime('last_access_on')->nullable();
            $table->boolean('email_notifications')->default(true);

            // Relations
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('avatar_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->system()->dropIfExists($this->tableName(self::TABLE_NAME));
    }
}
