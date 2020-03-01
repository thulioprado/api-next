<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directus_activity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action', 45);
            $table->integer('action_by')->unsigned()->default(0);
            $table->dateTime('action_on');
            $table->string('ip', 50);
            $table->string('user_agent', 255);
            $table->string('collection', 64);
            $table->string('item', 255);
            $table->dateTime('edited_on')->nullable();
            $table->text('comment')->charset('utf8mb4')->nullable();
            $table->dateTime('comment_deleted_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('directus_activity');
    }
}
