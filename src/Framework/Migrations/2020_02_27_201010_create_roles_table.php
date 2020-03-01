<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('description', 500)->nullable();
            $table->text('ip_whitelist')->nullable();
            $table->string('external_id', 255)->nullable();
            $table->text('module_listing')->nullable();
            $table->text('collection_listing')->nullable();
            $table->tinyInteger('enforce_2fa')->default(0);

            $table->unique('name', 'idx_group_name');
            $table->unique('external_id', 'idx_roles_external_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_roles');
    }
}
