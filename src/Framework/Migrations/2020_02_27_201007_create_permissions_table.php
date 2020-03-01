<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('collection', 64);
            $table->unsignedInteger('role');
            $table->string('status', 64)->nullable();
            $table->string('create', 16)->default('none');
            $table->string('read', 16)->default('none');
            $table->string('update', 16)->default('none');
            $table->string('delete', 16)->default('none');
            $table->string('comment', 8)->default('none');
            $table->string('explain', 8)->default('none');
            $table->string('read_field_blacklist', 1000)->nullable();
            $table->string('write_field_blacklist', 1000)->nullable();
            $table->string('status_blacklist', 1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_permissions');
    }
}
