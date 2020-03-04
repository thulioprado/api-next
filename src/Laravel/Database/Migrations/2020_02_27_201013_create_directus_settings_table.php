<?php

declare(strict_types=1);

use Directus\Laravel\Database\Traits\SystemBuilder;
use Directus\Laravel\Database\Traits\TableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusSettingsTable extends Migration
{
    use SystemBuilder;
    use TableName;

    /**
     * Table name.
     */
    private const TABLE_NAME = 'settings';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->tableName(self::TABLE_NAME), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 64)->unique();
            $table->text('value')->nullable();
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
