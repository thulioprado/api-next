<?php

declare(strict_types=1);

use Directus\Laravel\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectusSettingsTable extends Migration
{
    /**
     * Table name.
     */
    private const TABLE_NAME = 'settings';

    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->system()->create($this->table(self::TABLE_NAME), function (Blueprint $table) {
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
        $this->system()->dropIfExists($this->table(self::TABLE_NAME));
    }
}
