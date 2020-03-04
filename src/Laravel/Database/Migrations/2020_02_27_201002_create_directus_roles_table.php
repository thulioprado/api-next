<?php

declare(strict_types=1);

use Directus\Laravel\Database\Traits\SystemBuilder;
use Directus\Laravel\Database\Traits\TableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusRolesTable extends Migration
{
    use SystemBuilder;
    use TableName;

    /**
     * Table name.
     */
    private const TABLE_NAME = 'roles';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->tableName(self::TABLE_NAME), function (Blueprint $table) {
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
        $this->system()->dropIfExists($this->tableName(self::TABLE_NAME));
    }
}
