<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('collection_id', 64);

            // Track information
            $table->string('action', 45);
            $table->integer('action_by')->unsigned()->default(0);
            $table->dateTime('action_on');
            $table->string('item', 255);
            $table->dateTime('edited_on')->nullable();

            // Origin's information
            $table->string('ip', 50);
            $table->string('user_agent', 255);

            // Comment about the activity
            $table->text('comment')->charset('utf8mb4')->nullable();
            $table->dateTime('comment_deleted_on')->nullable();

            // Relations
            $table->foreign('collection_id')->references('name')->on('collections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
