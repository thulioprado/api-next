<?php

declare(strict_types=1);

use Directus\Laravel\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectusWebhooksTable extends Migration
{
    /**
     * Table name.
     */
    private const TABLE_NAME = 'webhooks';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->table(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('collection_id', 64)->nullable();

            // Settings
            $table->string('status', 16)->default('inactive');
            $table->string('http_action', 255)->nullable();
            $table->string('url', 510)->nullable();
            $table->string('directus_action', 255)->nullable();

            // Relations
            $table->foreign('collection_id')->references('name')->on('collections');
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
