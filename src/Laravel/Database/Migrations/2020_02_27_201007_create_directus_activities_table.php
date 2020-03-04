<?php

declare(strict_types=1);

use Directus\Laravel\Database\Traits\SystemBuilder;
use Directus\Laravel\Database\Traits\TableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusActivitiesTable extends Migration
{
    use SystemBuilder;
    use TableName;

    /**
     * Table name.
     */
    private const TABLE_NAME = 'activities';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->tableName(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('collection_id', 64);
            $table->string('item_id', 255);

            // Track information
            $table->string('action', 45);
            $table->integer('action_by')->unsigned()->default(0);
            $table->dateTime('action_on');
            $table->dateTime('edited_on')->nullable();

            // Origin's information
            $table->string('ip', 50);
            $table->string('user_agent', 255);

            // Comment about the activity
            $table->text('comment')->nullable();
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
        $this->system()->dropIfExists($this->tableName(self::TABLE_NAME));
    }
}
