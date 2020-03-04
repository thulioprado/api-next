<?php

declare(strict_types=1);

use Directus\Laravel\Database\Traits\SystemBuilder;
use Directus\Laravel\Database\Traits\TableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusFieldsTable extends Migration
{
    use SystemBuilder;
    use TableName;

    /**
     * Table name.
     */
    private const TABLE_NAME = 'fields';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->tableName(self::TABLE_NAME), function (Blueprint $table) {
            // Identification
            $table->bigIncrements('id');
            $table->string('collection_id', 64);
            $table->bigInteger('parent_id')->nullable();

            // Shape
            $table->string('field', 64);
            $table->string('type', 64);
            $table->string('interface', 64);
            $table->json('options')->nullable();

            // Settings
            $table->boolean('locked')->default(false);
            $table->boolean('required')->default(false);
            $table->boolean('readonly')->default(false);
            $table->boolean('hidden_detail')->default(false);
            $table->boolean('hidden_browse')->default(false);
            $table->unsignedInteger('index')->nullable();
            $table->string('width', 50)->default('full');
            $table->string('note', 1024)->nullable();

            // Internationalization
            $table->json('translation')->nullable();

            // Keys
            $table->unique(['collection', 'field']);

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
