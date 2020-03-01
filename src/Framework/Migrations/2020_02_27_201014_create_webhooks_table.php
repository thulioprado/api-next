<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_webhooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status', 16)->default('inactive');
            $table->string('http_action', 255)->nullable();
            $table->string('url', 510)->nullable();
            $table->string('collection', 255)->nullable();
            $table->string('directus_action', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_webhooks');
    }
}
