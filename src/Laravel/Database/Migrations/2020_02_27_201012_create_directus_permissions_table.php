<?php

declare(strict_types=1);

use Directus\Laravel\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectusPermissionsTable extends Migration
{
    /**
     * Table name.
     */
    private const TABLE_NAME = 'permissions';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->table(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('collection_id', 64);
            $table->unsignedBigInteger('role_id');

            // Settings
            $table->string('create', 16)->default('none');
            $table->string('read', 16)->default('none');
            $table->string('update', 16)->default('none');
            $table->string('delete', 16)->default('none');
            $table->string('comment', 8)->default('none');
            $table->string('explain', 8)->default('none');

            // Control
            $table->string('status', 64)->nullable();
            $table->string('status_blacklist', 1000)->nullable();
            $table->string('read_field_blacklist', 1000)->nullable();
            $table->string('write_field_blacklist', 1000)->nullable();

            // Relations
            $table->foreign('collection_id')->references('name')->on('collections');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->system()->dropIfExists($this->table(self::TABLE_NAME));
    }
}
