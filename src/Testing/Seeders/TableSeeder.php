<?php

declare(strict_types=1);

namespace Directus\Testing\Seeders;

use Directus\Contracts\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;

class TableSeeder implements Seeder
{
    public function run(): void
    {
        $database = directus()->databases()->database();

        $database->schema()->create('authors', static function (Blueprint $table): void {
            $table->integerIncrements('id');
            $table->string('name');
            $table->string('email');
        });

        $database->schema()->create('posts', static function (Blueprint $table): void {
            $table->integerIncrements('id');
            $table->integer('author_id');
            $table->string('title');
            $table->text('content');
            $table->timestamp('published')->nullable();
            $table->timestamp('edited')->nullable();
            $table->unsignedInteger('views');
            $table->foreign('author_id')->references('id')->on('authors');
        });
    }
}
