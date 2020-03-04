<?php

declare(strict_types=1);

use Directus\Laravel\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Table name.
     */
    private const TABLE_NAME = 'roles';

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection($this->system())->create($this->table(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('external_id', 255)->unique()->nullable();
            $table->string('name', 100)->unique();
            $table->string('description', 500)->nullable();

            // Rules
            $table->text('module_listing')->nullable();
            $table->text('collection_listing')->nullable();
            $table->text('ip_whitelist')->nullable();

            // Settings
            $table->boolean('enforce_2fa')->default(false);
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
